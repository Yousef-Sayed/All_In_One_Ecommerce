<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class DeletedController extends Controller
{
    public function index(){
        $tables = DB::select('SHOW TABLES');
        $tablesWithSoftDeletes = [];
        foreach ($tables as $table) {
            $tableName = reset($table);
            if (Schema::hasColumn($tableName, 'deleted_at')) {
                $tablesWithSoftDeletes[] = $tableName;
            }
        }
        return view('backend.Deleted.deleted',compact('tablesWithSoftDeletes'));
    }
}

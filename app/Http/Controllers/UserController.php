<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = User::select('*');
            return DataTables::of($data)->addIndexColumn()
            ->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y');
            })
            ->make(true);
        }
        return view('backend.users.users');
    }
}

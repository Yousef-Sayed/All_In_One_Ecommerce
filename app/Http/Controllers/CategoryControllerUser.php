<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use App\Models\backend\category;
use App\Models\backend\category;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryControllerUser extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show1($category)
    {
        $cats = $category;
        return view('backend.categories.show',compact('cats'));
    }


}

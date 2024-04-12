<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\backend\category;
use App\Models\backend\Prodecut;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class ProdecutController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        $showAll = Prodecut::get()->whereNull('deleted_at');
        return view('backend.prodecuts.showAll',compact('showAll'));
    }
    public function show(Request $request)
    {
        $prodectsSearch = Prodecut::where('nameEn','Like','%'.$request->search.'%') // Equivalent to Eloquent's `whereLike`
            ->orWhere('nameAr','Like','%'.$request->search.'%') // Case-insensitive "like" (database-dependent)
            ->get()->whereNull('deleted_at');

        // dd($prodectsSearch);
        return view('backend.prodecuts.search',compact('prodectsSearch'));
    }
}

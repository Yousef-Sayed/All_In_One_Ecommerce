<?php

namespace App\Http\Controllers;

use App\Models\backend\News;
use Illuminate\Http\Request;

class NewsUserController extends Controller
{

    public function index()
    {
        $newss = News::whereNull('deleted_at')->where('status',1)->get();
        return view('frontend.news',compact('newss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $newss = News::find($id);
        $titles = News::orderBy('created_at', 'desc')->pluck('title', 'id')->take(5);
        return view('frontend.single-news',compact(['titles','newss']));
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

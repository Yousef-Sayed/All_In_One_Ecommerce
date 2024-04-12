<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        Validator::make($request->all(), [
            'content' => 'required|min:3|string',
        ]);
        Reply::create([
            'content' => $request->content,
            'user_id' => $request->user_id,
            'news_id' => $request->news_id,
            'comment_id' => $request->comment_id
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }
    public function delete($id)
    {
        Reply::find($id)->delete();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        Validator::make($request->all(), [
            'content' => 'required|min:3|string',
        ]);
        Reply::find($request->reply_id)->update([
            'content' => $request->content,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }
}

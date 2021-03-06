<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //blog post comment

    public function postCommentAdd(Request $request)

    {
        Comment::create([

            'post_id'  => $request->post_id,
            'user_id'  => Auth::user()->id,
            'text'     => $request->comment,

        ]);

        return redirect()->back()->with('success','comment successfully post');
    }

    /**
     *
     */

     public function postCommentReply(Request $request)

     {
        Comment::create([

            'post_id'     =>$request->post_id,
            'user_id'     =>Auth::user()->id,
            'comment_id'  =>$request->comment_id,
            'text'        =>$request->reply
        ]);

        return redirect()->back()->with('success','comment successfully post');
     }
}

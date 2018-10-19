<?php

namespace Mercury\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Mercury\Comment;
use Mercury\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * creating a recored
     *
     * @param Request $request
     * @param Post $post
     * @return string
     */
    public function addComment(Request $request, Post $post)
    {
        if($post->status === 0){
            return response()->json(["message" => "Something went wrong"]);
        }
        return Comment::create($request->postId, $request->comment);
    }
    
    /**
     * deleting a comment
     *
     * @param Request $request
     * @param Post $post
     * @return string
     */
    public function deleteComment(Request $request, Post $post){
        return Comment::deleteComment($request->id);
    }

    /**
     * TODO :: make this work
     *
     * @param Request $request
     * @param Post $post
     * @return null
     */
    public function editComment(Request $request, Post $post){
        return Comment::edit($request->id, $request->newComment);
    }
}

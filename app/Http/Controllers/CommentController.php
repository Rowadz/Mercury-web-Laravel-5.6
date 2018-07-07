<?php

namespace Mercury\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Mercury\Comment;
use Mercury\Post;

class CommentController extends Controller
{
    public function addComment(Request $request, Post $post){
        $comment = new Comment;
        $comment->user_id = Auth()->user()->id;
        $comment->post_id = $request->postId;
        $comment->body = strip_tags($request->comment);
        $comment->save();
        return response()->json(["Success" => "Comment added"]);
    }
}

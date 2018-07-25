<?php

namespace Mercury\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Mercury\Comment;
use Mercury\Post;

class CommentController extends Controller
{
    public function addComment(Request $request, Post $post){
        if(Comment::create($request->postId, $request->comment)){
            return response()->json(["message" => "Comment added"]);
        } else {
            return response()->json(["message" => "Something went wrong"]);
        }
    }

    // TODO
    // 1 - update comment
    // 2 - delete comment
    
}

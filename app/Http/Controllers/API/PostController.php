<?php

namespace Mercury\Http\Controllers\API;

use Illuminate\Http\Request;
use Mercury\Http\Controllers\Controller;
use Mercury\Post;
use Mercury\Wish;

class PostController extends Controller
{
    public function paginate()
    {
        return response()->json(
            Post::with('user')
                ->with('postImages')
                ->with('tag')
                ->orderBy('created_at', 'desc')
                ->paginate(10));
    }

    public function get(int $id)
    {
        return response()->json(
            Post::with('user')
                ->with('postImages')
                ->with('tag')
                ->with('comments.user')
                ->find($id)
        );
    }

    public function isWished(int $postId, int $userId)
    {

        return response()->json(Wish::Where([
            'user_id' => $userId,
            'post_id' => $postId,
        ])->first());

    }

    public function bookmark(Request $req)
    {
        if (!$wish = Wish::where([
            'user_id' => $req->userId,
            'post_id' => $req->postId,
        ])->first()) {
            $wish = new Wish();
            $wish->post_id = $req->postId;
            $wish->user_id = $req->userId;
            $wish->save();
            return response()->json(["message" => "You just saved this post !"]);
        } else {
            return response()->json(["message" => "Already saved"]);
        }
    }

    public function deleteBookmark(Request $req)
    {
        Wish::where([
            'user_id' => $req->userId,
            'post_id' => $req->postId,
        ])->first()->delete();
        return response()->json(["message" => "The Wish has been deleted"]);
    }
}

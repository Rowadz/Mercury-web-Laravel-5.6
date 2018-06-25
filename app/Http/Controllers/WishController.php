<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mercury\Post;
use Mercury\Wish;

class WishController extends Controller
{
    public function __constrct()
    {
        $this->middleware('auth');
    }

    public function addPostToWishList(Request $request, Post $post){

        $wish = new Wish();
        $wish->post_id = $request->id;
        $wish->user_id = Auth()->user()->id;
        $wish->save();
        return response()->json(["success" => "You just saved this post!"]);
    }

    public function showAllPosts(){
        $data = [
            "wished" => Wish::where('user_id', Auth()->user()->id)->get(),
            "wishes" => Wish::where("user_id", Auth()->user()->id)->count()
        ];
        return view("user.wishedPosts")->with($data);
    }

    public function deleteWish(Request $request, Wish $wish){
        if ($wish){
            Wish::find($request->id)->delete();
            return response()->json(["success" => "The Wish has been deleted"]);
        }
        return response()->json(["error" => "Something went wrong"]);
    }
}

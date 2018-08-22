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
        $validatedData = $request->validate([
            'id' => 'required|exists:posts,id'
        ]);
        return Wish::create($request->id);
    }

    public function showWishedPosts(Request $request){
        $validatedData = $request->validate([
            'lowestId' => 'numeric'
        ]);
        return Wish::getWishes($request->lowestId ?: null);
    }

    public function deleteWish(Request $request, Wish $wish){
        $validatedData = $request->validate([
            'id' => 'required|numeric|exists:wishes,post_id'
        ]);
        return Wish::deleteWish($request->id);
    }
}

<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mercury\Post;
use Mercury\Wish;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'showWithNoAuth', 'loadMorePostsNoAuth']);
    }
    public function show(Post $post){

        if (Auth::check()) {
            $isWished = Wish::where("post_id", $post->id)->where("user_id", Auth()->user()->id)->get()->count();
            $wishes =  Wish::getWishes();
        } else {
            $isWished = null;
            $wishes = null;
        }

        $data = [
            "post" => $post,
            "postImages" => $post->postImages,
            "comments" => $post->comments,
            // "comments" => null,
            "isWished" => $isWished,
            "wishes" => Wish::getWishes()

        ];
        return view("user.showPost")->with($data);
    }


    public function showWithNoAuth(){
        // $posts = Post::where('status', 1)->orderBy('created_at')->take(10)->get();
        $data = [
            'posts' =>  Post::tenPosts()
        ];
        return view("visitor.showAllPosts")->with($data);
    }
    public function loadMorePostsNoAuth(Request $request)
    {
        return Post::loadMorePosts($request->lastId);
    //     $posts = Post::where('status', 1)->where('id', '>', $request->lastId)->orderBy('created_at')->take(10)->get();

    //     $commentNumber = [];
    //     $tagNames = [];
    //     $users = [];
    //     $imageLocation = [];
    //     foreach ($posts as $key => $post) {
    //         $commentNumber[$key] = $post->comments->count();
    //         $tagNames[$key] = $post->tag->name;
    //         $users[$key] = $post->user->name;
    //         foreach ($post->postImages as $image){
    //             $imageLocation[$key] = $image->location;
    //             break;
    //         }
    //     }
    //     return response()->json(["posts" => $posts,
    //         "commentNumber" => $commentNumber,
    //         "tagNames" => $tagNames,
    //         'users' => $users,
    //         'imageLocation' => $imageLocation]);
    }
}

<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mercury\User;
use Mercury\Follower;
use Mercury\Post;
use Mercury\PostImage;
use Carbon\Carbon;
use Mercury\Wish;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['welcome']);
    }

    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allFollowers = Follower::allFollowers();
        $allFollowedByTheUser = Follower::allFollowedByTheUser();
        // $posts = Post::where('status', 1)->orderBy('created_at')->take(10)->get();
        $posts = Post::tenPosts();
        $wishes = Wish::getWishes();
        $data = [
            'posts' => $posts
        ];

        return view('home')->with($data);
    }

    public function loadMorePosts(Request $request)
    {
        return Post::loadMorePosts($request->lastId);
        // $posts = Post::where('status', 1)->where('id', '>', $request->lastId)->orderBy('created_at')->take(10)->get();

        // $commentNumber = [];
        // $tagNames = [];
        // $users = [];
        // $imageLocation = [];
        // foreach ($posts as $key => $post) {
        //     $commentNumber[$key] = $post->comments->count();
        //     $tagNames[$key] = $post->tag->name;
        //     $users[$key] = $post->user->name;
        //     foreach ($post->postImages as $image){
        //         $imageLocation[$key] = $image->location;
        //         break;
        //     }
        // }
        // return response()->json(["posts" => $posts,
        //     "commentNumber" => $commentNumber,
        //     "tagNames" => $tagNames,
        //     'users' => $users,
        //     'imageLocation' => $imageLocation]);
    }
}
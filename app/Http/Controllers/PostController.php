<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mercury\Post;
use Mercury\Wish;
use Mercury\Follower;
use Mercury\User;


// Defualt data that you need to return 

// "wishes" => Wish::getWishes(),
// "allFollowers" => Follower::allFollowers(),
// "allFollowedByTheUser" => Follower::allFollowedByTheUser(),


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'showWithNoAuth', 'loadMorePostsNoAuth']);
    }

    // TODO add the default in the defaults method 
    // for DRY
    private function defaults(){
        
    }

    // View -> User => showPost.blade.php 
    // Route => get('/show/post/{post}')
    // for thge Visitor or the User
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

        ];
        return view("user.showPost")->with($data);
    }

    // View =>  Visitor ->  showAllPosts.blade.php
    // Route get("/show/all/posts")
    public function showWithNoAuth(){
        // $posts = Post::where('status', 1)->orderBy('created_at')->take(10)->get();
        $data = [
            'posts' =>  Post::tenPosts()
        ];
        return view("visitor.showAllPosts")->with($data);
    }

    // View => home.blade.php
    // Route => post("/show/all/postsNoAuth")
    // WHY => for AJAX call 
    public function loadMorePostsNoAuth(Request $request)
    {
        return Post::loadMorePosts($request->lastId, $request->userId);
    }
    
    // DRY :'(
    // View => User -> showUserPosts.blade.php
    // Route => get('/posts/{user}')
    // Route => get('/posts/{user}/DescendingNAvailable/')
    public function DescendingNAvailable(User $user){
        $data = [
            "posts" => Post::sortPosts(1, 0, $user->id),
            "sortType" => 'descending order for Date',
            "postsType" => 'Available',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    // View => User -> showUserPosts.blade.php
    // Route => get('/posts/{user}/AscendingNAvailable')
    public function AscendingNAvailable(User $user){
        $data = [
            "posts" => Post::sortPosts(1, 1, $user->id),
            "sortType" => 'Ascending order for Date',
            "postsType" => 'Available',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    // View => User -> showUserPosts.blade.php
    // Route => get('/posts/{user}/DescendingNArchived')
    public function DescendingNArchived(User $user){
        $data = [
            "posts" => Post::sortPosts(0, 0, $user->id),
            "sortType" => 'Descending order for Date',
            "postsType" => 'Archived',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    // View => User -> showUserPosts.blade.php
    // Route => get('/posts/{user}/AscendingNArchived')
    public function AscendingNArchived(User $user){
        $data = [
            "posts" => Post::sortPosts(0, 1, $user->id),
            "sortType" => 'Ascending order for Date',
            "postsType" => 'Archived',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    // View => User -> showUserPosts.blade.php
    // Route => get('/posts/{user}/commentsNAvailable')
    public function commentsNAvailable(User $user){
        $data = [
            "posts" => Post::sortPosts(1, 2, $user->id),
            "sortType" => 'Order By comments number',
            "postsType" => 'Available',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    // View => User -> showUserPosts.blade.php
    // Route => get('/posts/{user}/commentsNArchived')
    public function commentsNArchived(User $user){
        $data = [
            "posts" => Post::sortPosts(0, 2, $user->id),
            "sortType" => 'Order By comments number',
            "postsType" => 'Archived',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    public function loadUserPosts(Request $request){
        $validatedData = $request->validate([
            'lastId' => 'required|numeric',
            'userId' => 'required|numeric|exists:users,id'
        ]);
        return Post::loadMorePosts($request->lastId, $request->userId);
    }


    public function getPostdataExchangeRequest($keyword){
        return Post::getPostdataExchangeRequest($keyword);
    }
}
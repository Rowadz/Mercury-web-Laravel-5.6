<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mercury\Post;
use Mercury\Wish;
use Mercury\Follower;
use Mercury\User;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'showWithNoAuth', 'loadMorePostsNoAuth']);
    }


    /**
     * * View -> User => showPost.blade.php
     * * Route => get('/show/post/{post}')
     * * for thge Visitor or the User
     * @param Post $post
     * @return void
     */
    public function show(Post $post)
    {

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
            "isWished" => $isWished,

        ];
        return view("user.showPost")->with($data);
    }
 
    /**
     * * View =>  Visitor ->  showAllPosts.blade.php
     * * Route get("/show/all/posts")
     * @return void
     */
    public function showWithNoAuth()
    {
        $data = [
            'posts' =>  Post::tenPosts()
        ];
        return view("visitor.showAllPosts")->with($data);
    }
 
    /**
     * * View => home.blade.php
     * * Route => post("/show/all/postsNoAuth")
     * * WHY => for AJAX call 
     * @param Request $request
     * @return void
     */
    public function loadMorePostsNoAuth(Request $request)
    {
        return Post::loadMorePosts($request->lastId, $request->userId);
    }

    /**
     * * View => User -> showUserPosts.blade.php
     * * Route => get('/posts/{user}')
     * * Route => get('/posts/{user}/DescendingNAvailable/')
     * @param User $user
     * @return void
     */
    public function DescendingNAvailable(User $user)
    {
        $data = [
            "posts" => Post::sortPosts('available', 0, $user->id),
            "sortType" => 'descending order for Date',
            "postsType" => 'Available',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    /**
     * Undocumented function
     * * View => User -> showUserPosts.blade.php
     * * Route => get('/posts/{user}/AscendingNAvailable')
     * @param User $user
     * @return void
     */
    public function AscendingNAvailable(User $user)
    {
        $data = [
            "posts" => Post::sortPosts('available', 1, $user->id),
            "sortType" => 'Ascending order for Date',
            "postsType" => 'Available',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    /**
     * * View => User -> showUserPosts.blade.php
     * * Route => get('/posts/{user}/DescendingNArchived')
     * @param User $user
     * @return void
     */
    public function DescendingNArchived(User $user)
    {
        $data = [
            "posts" => Post::sortPosts('archive', 0, $user->id),
            "sortType" => 'Descending order for Date',
            "postsType" => 'Archived',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    /**
     * * View => User -> showUserPosts.blade.php
     * * Route => get('/posts/{user}/AscendingNArchived')
     * @param User $user
     * @return void
     */
    public function AscendingNArchived(User $user)
    {
        $data = [
            "posts" => Post::sortPosts('archive', 1, $user->id),
            "sortType" => 'Ascending order for Date',
            "postsType" => 'Archived',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    /**
     * * View => User -> showUserPosts.blade.php
     * * Route => get('/posts/{user}/commentsNAvailable')
     * @param User $user
     * @return void
     */
    public function commentsNAvailable(User $user)
    {
        $data = [
            "posts" => Post::sortPosts('available', 2, $user->id),
            "sortType" => 'Order By comments number',
            "postsType" => 'Available',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }
    
    /**
     * * View => User -> showUserPosts.blade.php
     * * Route => get('/posts/{user}/commentsNArchived')
     * @param User $user
     * @return void
     */
    public function commentsNArchived(User $user)
    {
        $data = [
            "posts" => Post::sortPosts('archive', 2, $user->id),
            "sortType" => 'Order By comments number',
            "postsType" => 'Archived',
            "user" => $user
        ];
        return view('user.showUserPosts')->with($data);
    }

    /**
     * 
     *
     * @param Request $request
     * @return void
     */
    public function loadUserPosts(Request $request)
    {
        $validatedData = $request->validate([
            'lastId' => 'required|numeric',
            'userId' => 'required|numeric|exists:users,id'
        ]);
        return Post::loadMorePosts($request->lastId, $request->userId);
    }


    /**
     *
     * @param string $keyword
     * @return void
     */
    public function getPostdataExchangeRequest($keyword)
    {
        return Post::getPostdataExchangeRequest($keyword);
    }

}
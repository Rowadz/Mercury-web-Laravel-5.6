<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Mercury\User;
use Mercury\Wish;
use Mercury\Follower;


// default data you need to return te every Auth View 
// "wishes" => Wish::getWishes(),
// "allFollowers" => Follower::allFollowers(),
// "allFollowedByTheUser" => Follower::allFollowedByTheUser(),
class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(User $user){
        $iamIFollowingThisUser = Follower::iamIFollowingThisUser($user->id);
        // return the row id if the user send a follow request
        if($iamIFollowingThisUser === 0 || $iamIFollowingThisUser === 1){
            $followId = Follower::getRowId($user->id);
        }
    	$data = [
            "user" => $user,
            "posts" => $user->posts()->orderBy('created_at', 'desc')->take(10)->get(),
            "iamIFollowingThisUser" => Follower::iamIFollowingThisUser($user->id),
            "followId" => (isset($followId)) ? $followId : null,
            'followers' => Follower::followersProfile($user->id),
            'following' => Follower::followingProfile($user->id)
        ];
    	return view("user.profile")->with($data);
    }

    public function newFollowerRequestedName(Request $request, User $user){
    	return Follower::newFollowerRequestedName();
    }

    public function showFollowingRequests(Request $request){
    	return  Follower::allRequests();
    }

    public function approveFollow(Request $request){
        return Follower::approve($request->from_id);
    }

    public function declineFollow(Request $request){
        return Follower::decline($request->from_id);
    }

    public function seeFollowers(){
        $data = [
            'Followers' => Follower::seeFollowers(),
        ];
        dd($data);
        return view("user.followers")->with($data);
    }

    public function seeTheUsersYouAreFollowing(){
        $data = [
            'theFollowers' => Follower::seeTheUsersYouAreFollowing(),
        ];
        $u = Follower::seeTheUsersYouAreFollowing();
        return view("user.following")->with($data);
    }

    public function unFollow(Request $request){
        return Follower::unFollow($request->id);
    }

    public function follow(Request $request){
        return Follower::follow($request->id);
    }

    // TODO if every thing went correctly return back() with nothing 
    // if something went wrong return back() with error message
    public function cancelFollow(Request $request){
        Follower::cancel($request->row_id);
        return back();
    }

    // TODO if every thing went correctly return back() with nothing 
    // if something went wrong return back() with error message
    public function followUser(Request $request){
        Follower::followUser($request->user_id);
        return back();
    }

    // TODO if every thing went correctly return back() with nothing 
    // if something went wrong return back() with error message
    public function unfollowUser(Request $request){
        Follower::unfollowUser($request->row_id);
        return back();
    }

}

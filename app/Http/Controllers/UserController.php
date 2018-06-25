<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Mercury\User;
use Mercury\Wish;
use Mercury\Follower;

class UserController extends Controller
{
    public function profile(User $user){
        $iamIFollowingThisUser = Follower::iamIFollowingThisUser($user->id);
        // return the row id if the user send a follow request
        if($iamIFollowingThisUser === 2 || $iamIFollowingThisUser === 0 || $iamIFollowingThisUser === 1){
            $followId = Follower::getRowId($user->id);
        }
    	$data = [
            "user" => $user,
            "posts" => $user->posts()->orderBy('created_at', 'desc')->take(10)->get(),
    		"wishes" => Wish::getWishes(),
    		"allFollowers" => Follower::allFollowers(),
    		"allFollowedByTheUser" => Follower::allFollowedByTheUser(),
            "iamIFollowingThisUser" => Follower::iamIFollowingThisUser($user->id),
            "followId" => (isset($followId)) ? $followId : null
        ];
    	return view("user.profile")->with($data);
    }

    public function newFollowerRequestedName(Request $request, User $user){
    	return Follower::newFollowerRequestedName();
    }

    public function showFollowingRequests(Request $request){
    	$data = [
    		"wishes" => Wish::getWishes(),
    		"allFollowers" => Follower::allFollowers(),
    		"allFollowedByTheUser" => Follower::allFollowedByTheUser(),
    		"followers" => Follower::allRequests()
    	];
    	return view("user.followingRequests")->with($data);
    }

    public function approveFollow(Request $request){
        return Follower::approve($request->id);
    }

    public function declineFollow(Request $request){
        return Follower::decline($request->id);
    }

    public function seeFollowers(){
        $data = [
            'Followers' => Follower::seeFollowers(),
            "wishes" => Wish::getWishes(),
            "allFollowers" => Follower::allFollowers(),
            "allFollowedByTheUser" => Follower::allFollowedByTheUser()
        ];
        return view("user.followers")->with($data);
    }

    public function unFollow(Request $request){
        return Follower::unFollow($request->id);
    }

    public function follow(Request $request){
        return Follower::follow($request->id);
    }

    public function cancelFollow(Request $request){
        Follower::cancel($request->row_id);
        return back();
    }
}

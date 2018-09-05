<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Mercury\User;
use Mercury\Wish;
use Mercury\Follower;
use Mercury\ExchangeRequest;
use Mercury\Post;



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
        $validatedData = $request->validate([
            'from_id' => 'required|exists:followers,from_id'
        ]);
        return Follower::approve($request->from_id);
    }

    public function declineFollow(Request $request){
        $validatedData = $request->validate([
            'from_id' => 'required|exists:followers,from_id'
        ]);
        return Follower::decline($request->from_id);
    }

    public function seeFollowers(Request $request){
        $validatedData = $request->validate([
            'highestId' => 'numeric'
        ]);
        return Follower::seeFollowers($request->highestId ?: null);
    }

    public function seeTheUsersYouAreFollowing(Request $request){
        $validatedData = $request->validate([
            'highestId' => 'numeric'
        ]);
        return Follower::seeTheUsersYouAreFollowing($request->highestId ?: null);
    }

    // public function unFollow(Request $request){
    //     $validatedData = $request->validate([
    //         'id' => 'required|exists:followers,user_id'
    //     ]);
    //     return Follower::unFollow($request->id);
    // }

    // public function follow(Request $request){
    //     $validatedData = $request->validate([
    //         'id' => 'required|numeric,'
    //     ]);
    //     return Follower::follow($request->id);
    // }

    public function cancelFollow(Request $request){
        $validatedData = $request->validate([
            'row_id' => 'required|exists:followers,id'
        ]);
        Follower::cancel($request->row_id);
        return back();
    }


    public function followUser(Request $request){
        $validatedData = $request->validate([
            'user_id' => 'required|numeric'
        ]);
        Follower::followUser($request->user_id);
        return back();
    }

    
    public function unfollowUser(Request $request){
        $validatedData = $request->validate([
            'row_id' => 'required|exists:followers,id'
        ]);
        Follower::unfollowUser($request->row_id);
        return back();
    }

    public function sendExchangeRequest(Request $request){
        $validatedData = $request->validate([
            'postId' => 'required|numeric|exists:posts,id',
            'userPostId' => 'required|numeric|exists:posts,id'
        ]);
        if(Post::checkPostStatus($request->postId, 1) && Post::checkPostStatus($request->userPostId, 1)){
            return ExchangeRequest::sendExchangeRequest($request->userPostId, $request->postId);    
        } else {
            return response()->json(["On the wrong side 🤬🤬, don't miss with our server side monkeys" => "🐒🐒🐒🐒🐒🐒🐒🐒"]);
        }
    }

    public function seeExchangeRequest(){
        return view('user.exchangeRequests')->with(["exchangeRequests" => ExchangeRequest::dataForTheExchangeRequstsView()]);
    }

    public function exchangeRequestLoadMore(Request $request){
        $validatedData = $request->validate([
            'idToSend' => 'numeric|exists:exchange_requests,id'
        ]);
        return ExchangeRequest::loadMore($request->idToSend, $request->turn);
    }

    public function seeExchangeRequestDESC(){
        return ExchangeRequest::loadMore(null, 'DESC');
    }

    public function seeExchangeRequestASC(){
        return ExchangeRequest::loadMore(null, 'ASC');
    }

    public function acceptExchangeRequest(Request $request){
        $validatedData = $request->validate([
            'exchangeRequestInfo.exchangeRequestId' => 'numeric|exists:exchange_requests,id',
            'exchangeRequestInfo.postId' => 'numeric|exists:exchange_requests,original_post_id',
            'exchangeRequestInfo.theOtherPostId' => 'numeric|exists:exchange_requests,post_id'
        ]);
        if(ExchangeRequest::checkIfExchangeRequestExist($request->exchangeRequestInfo['exchangeRequestId'], $request->exchangeRequestInfo['postId'], $request->exchangeRequestInfo['theOtherPostId'])){
            return ExchangeRequest::acceptExchangeRequest($request->exchangeRequestInfo['exchangeRequestId'], $request->exchangeRequestInfo['postId'], $request->exchangeRequestInfo['theOtherPostId']);
        } else return response()->json(["message" => 'the post already exchanged ! ¯\_(ツ)_/¯']);
    }

    public function deleteExchangeRequest(Request $request){
        $validatedData = $request->validate([
            'exchangeRequestInfo.exchangeRequestId' => 'numeric|exists:exchange_requests,id',
            'exchangeRequestInfo.postId' => 'numeric|exists:exchange_requests,original_post_id',
            'exchangeRequestInfo.theOtherPostId' => 'numeric|exists:exchange_requests,post_id'
        ]);
        if(ExchangeRequest::checkIfExchangeRequestExist($request->exchangeRequestInfo['exchangeRequestId'], $request->exchangeRequestInfo['postId'], $request->exchangeRequestInfo['theOtherPostId'])){
            return ExchangeRequest::deleteExchangeRequest($request->exchangeRequestInfo['exchangeRequestId']);
        } else return response()->json(["message" => '¯\_(ツ)_/¯']);
    }

    public function exploreTageReturnView($keyword = null){
        return view('exploreTags');
    }
}
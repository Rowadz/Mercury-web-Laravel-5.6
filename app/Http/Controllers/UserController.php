<?php

namespace Mercury\Http\Controllers;

use Illuminate\Http\Request;
use Mercury\ExchangeRequest;
use Mercury\Follower;
use Mercury\Post;
use Mercury\Review;
use Mercury\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['searchPage']);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function profile(User $user)
    {
        $iamIFollowingThisUser = Follower::iamIFollowingThisUser($user->id);
        // return the row id if the user send a follow request
        if ($iamIFollowingThisUser === 'canCancel' || $iamIFollowingThisUser === 'canUnfollow') {
            $followId = Follower::getRowId($user->id);
        }
        // dd(Follower::iamIFollowingThisUser($user->id));
        $data = [
            "user" => $user,
            "reviews" => Review::reviewDataCount($user),
            "exchangeRequests" => ExchangeRequest::exchangeRequestsProfile($user->id),
            "followingFeedProfile" => Follower::followingFeedProfile($user->id),
            "iamIFollowingThisUser" => Follower::iamIFollowingThisUser($user->id),
            "followId" => (isset($followId)) ? $followId : null,
            'followers' => Follower::followersProfile($user->id),
            'following' => Follower::followingProfile($user->id),
        ];
        return view("user.profile")->with($data);
    }

    /**
     *
     *  this method will return all the follow request that are still pending to the current authed user
     * @param Request $request
     * @return array
     */
    public function showFollowingRequests(Request $request)
    {
        return Follower::allRequests();
    }

    /**
     * this method will change the status to a follow request to accepted
     *
     * @param Request $request
     * @return string
     */
    public function approveFollow(Request $request)
    {
        $validatedData = $request->validate([
            'from_id' => 'required|exists:followers,from_id',
        ]);
        return Follower::approve($request->from_id);
    }

    /**
     * this method will delete the follow request
     *
     * @param Request $request
     * @return string
     */
    public function declineFollow(Request $request)
    {
        $validatedData = $request->validate([
            'from_id' => 'required|exists:followers,from_id',
        ]);
        return Follower::decline($request->from_id);
    }

    /**
     * will get the followers of the current authed user
     *
     * @param Request $request
     * @return array
     */
    public function seeFollowers(Request $request)
    {
        $validatedData = $request->validate([
            'highestId' => 'numeric',
        ]);
        return Follower::seeFollowers($request->highestId ?: null);
    }

    /**
     * will get the people that the current authed user is following
     *
     * @param Request $request
     * @return array
     */
    public function seeTheUsersYouAreFollowing(Request $request)
    {
        $validatedData = $request->validate([
            'highestId' => 'numeric',
        ]);
        return Follower::seeTheUsersYouAreFollowing($request->highestId ?: null);
    }

    /**
     * will delete the follow request,
     * that already sent by the user
     * @param Request $request
     * @return boolean
     */
    public function cancelFollow(Request $request)
    {
        // TODO :: check if the user sent the request is allowed to cancel the request
        $validatedData = $request->validate([
            'row_id' => 'required|exists:followers,id',
        ]);
        Follower::cancel($request->row_id);
        return back();
    }

    /**
     * send a follow to a user based on their id
     *
     * @param Request $request
     * @return void
     */
    public function followUser(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
        ]);
        Follower::followUser($request->user_id);
        return back();
    }

    /**
     * delete the follow recored from DB
     * @param Request $request
     * @return void
     */
    public function unfollowUser(Request $request)
    {
        $validatedData = $request->validate([
            'row_id' => 'required|exists:followers,id',
        ]);
        Follower::unfollowUser($request->row_id);
        return back();
    }

    /**
     * rejester in the DB that the authed user sent an exchange request,
     * with his/her post to another user's posts,
     * the data =>
     * 1 - the post's id which is the id of the post that the current user wants to exchange with
     * 2 - userPostId => is the id of the post that the current authed user sent
     *
     * @param Request $request
     * @return void
     */
    public function sendExchangeRequest(Request $request)
    {
        $validatedData = $request->validate([
            'owner_post_id' => 'required|numeric|exists:posts,id',
            'user_post_id' => 'required|numeric|exists:posts,id',
        ]);
        if (Post::checkPostStatus($request->owner_post_id, 'available') && Post::checkPostStatus($request->user_post_id, 'available')) {
            return ExchangeRequest::sendExchangeRequest($request->user_post_id, $request->owner_post_id, $request->user_id);
        } else {
            return response()->json(["message" => "🐒🐒🐒🐒🐒🐒🐒🐒"]);
        }

    }

    /**
     * will send the user to a view with data to see his/her exchange requests
     *
     * @return void
     */
    public function seeExchangeRequest()
    {
        $exchangeRequests = ExchangeRequest::dataForTheExchangeRequstsView();
        return view('user.exchangeRequests', compact('exchangeRequests'));
    }

    /**
     * there is a pagination on the exchange requests,
     * so this method will receive an id that tells us the post id,
     * so we can get the posts with higher or lower id based on the turn.
     *
     * @param Request $request
     * @return array
     */
    public function exchangeRequestLoadMore(Request $request)
    {
        $validatedData = $request->validate([
            'idToSend' => 'numeric|exists:exchange_requests,id',
        ]);
        return ExchangeRequest::loadMore($request->idToSend, $request->turn);
    }

    /**
     * will load the posts sent as an exchange request with DESCENDING order
     *
     * @return array
     */
    public function seeExchangeRequestDESC()
    {
        return ExchangeRequest::loadMore(null, 'DESC');
    }

    /**
     * will load the posts sent as an exchange request with Ascending order
     *
     * @return void
     */
    public function seeExchangeRequestASC()
    {
        return ExchangeRequest::loadMore(null, 'ASC');
    }

    /**
     * will accept the exchange request !
     *
     * @param Request $request
     * @return void
     */
    public function acceptExchangeRequest(Request $request)
    {
        // TODO :: if every thing went good we need to notify the user who sent the request
        // TODO :: and tell the both users to start chatting !
        $validatedData = $request->validate([
            'exchangeRequestInfo.exchangeRequestId' => 'numeric|exists:exchange_requests,id',
            'exchangeRequestInfo.user_post_id' => 'numeric|exists:exchange_requests,user_post_id',
            'exchangeRequestInfo.owner_post_id' => 'numeric|exists:exchange_requests,owner_post_id',
        ]);
        if (ExchangeRequest::checkIfExchangeRequestExist($request->exchangeRequestInfo['exchangeRequestId'], $request->exchangeRequestInfo['user_post_id'], $request->exchangeRequestInfo['owner_post_id'])) {
            return ExchangeRequest::acceptExchangeRequest($request->exchangeRequestInfo['exchangeRequestId'], $request->exchangeRequestInfo['user_post_id'], $request->exchangeRequestInfo['owner_post_id']);
        } else {
            return response()->json(["message" => 'the post already exchanged ! ¯\_(ツ)_/¯']);
        }

    }

    /**
     * just deleting the record
     *
     * @param Request $request
     * @return void
     */
    public function deleteExchangeRequest(Request $request)
    {
        $validatedData = $request->validate([
            'exchangeRequestInfo.exchangeRequestId' => 'numeric|exists:exchange_requests,id',
            'exchangeRequestInfo.user_post_id' => 'numeric|exists:exchange_requests,user_post_id',
            'exchangeRequestInfo.owner_post_id' => 'numeric|exists:exchange_requests,owner_post_id',
        ]);
        if (ExchangeRequest::checkIfExchangeRequestExist($request->exchangeRequestInfo['exchangeRequestId'], $request->exchangeRequestInfo['user_post_id'], $request->exchangeRequestInfo['owner_post_id'])) {
            return ExchangeRequest::deleteExchangeRequest($request->exchangeRequestInfo['exchangeRequestId']);
        } else {
            return response()->json(["message" => '¯\_(ツ)_/¯']);
        }

    }

    /**
     * will just send the user to a search page
     *
     * @param string $keyword
     * @return void
     */
    public function searchPage(string $keyword = null)
    {
        return view('searchPage');
    }

    public function reviewPage()
    {
        return view('user.peopleToReview')->with('finalUsers', ExchangeRequest::getPeopleToReview());
    }

    public function addReview(Request $request)
    {
        return Review::addReview($request->userId, $request->type, $request->header, $request->body);
    }
}

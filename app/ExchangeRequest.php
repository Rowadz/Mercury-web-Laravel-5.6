<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Mercury\Post;
use Mercury\User;

class ExchangeRequest extends Model
{
    // who sent the request
    /**
     * each recored in the exchange requst will
     * belong to one user => the onwer => the user that created the recored => the user how sent the request
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo("Mercury\User", 'user_id');
    }

    public function onwer()
    {
        return $this->belongsTo("Mercury\User", 'owner_id');
    }

    /**
     * each recored in the exhange request table
     * will belong to one post through the original_post_id
     *
     * @return void
     */
    public function userPost()
    {
        return $this->belongsTo("Mercury\Post", "user_post_id");
    }

    public function onwerPost()
    {
        return $this->belongsTo("Mercury\Post", "owner_post_id");
    }

    public function onwerToReview()
    {
        return $this->belongsTo('Mercury\Review', 'owner_id', 'from_id');
    }

    public function userToReview()
    {
        return $this->belongsTo('Mercury\Review', 'user_id', 'user_id');
    }

    /**
     * getting how many exchange requests was sent to the user
     *
     * @return integer|null
     */
    public static function exchangeRequestCount()
    {
        if (isset(Auth()->user()->id)) {
            return ExchangeRequest::where([
                'user_id' => Auth()->user()->id,
                'status' => 'pending',
            ])->count();
        } else {
            return null;
        }

    }

    /**
     * adding a recored !
     *
     * @param integer $userPostId
     * @param integer $postId
     * @return void
     */
    public static function sendExchangeRequest($userPostId, $ownerPostId, $userId)
    {
        if (!ExchangeRequest::where([
            'user_id' => $userId,
            'owner_post_id' => $ownerPostId,
            'user_post_id' => $userPostId,
            'owner_id' => Auth()->user()->id,
            'status' => 'pending',
        ])->first()) {
            $exchangeRequest = new ExchangeRequest();
            $exchangeRequest->user_id = $userId;
            $exchangeRequest->user_post_id = $userPostId;
            $exchangeRequest->owner_post_id = $ownerPostId;
            $exchangeRequest->owner_id = Auth()->user()->id;
            $exchangeRequest->status = 'pending';
            if ($exchangeRequest->save()) {
                $data = [
                    'event' => 'newExchangeRequestNotify',
                    'data' => [
                        'userId' => $userId,
                        'username' => Auth()->user()->name,
                    ],
                ];
                Redis::publish('notification', json_encode($data));
                return response()->json([
                    "message" => "Sent 🐵",
                ]);
            }
        } else {
            return response()->json(["message" => "Already Sent!! 🙊🙊"]);
        }

    }

    /**
     * getting the exchange request for the user
     *
     * @param boolean $DESC
     * @return array
     */
    public static function dataForTheExchangeRequstsView($DESC = true)
    {
        return ExchangeRequest::with('userPost.postImages')->with('onwerPost.postImages')
            ->where([
                'user_id' => Auth()->user()->id,
                'status' => 'pending',
            ])->Paginate(20);
    }

    /**
     * getting more exchange requests based in the id and 'DESC' or 'ASC'
     *
     * @param integer $id
     * @param integer $shouldItBeDESC
     * @return array
     */
    public static function loadMore($id = null, $shouldItBeDESC)
    {

    }

    /**
     * checking if request exists or no
     *
     * @param integer $rowId
     * @param integer $postId
     * @param integer $theOtherPostId
     * @return boolean
     */
    public static function checkIfExchangeRequestExist($rowId, $postId, $theOtherPostId)
    {
        if (ExchangeRequest::where([
            'id' => $rowId,
            'owner_post_id' => $theOtherPostId,
            'user_post_id' => $postId,
            'status' => 'pending',
        ])->first()) {
            return true;
        }

        return false;
    }

    /**
     *  this method will
     * * change the status of the exchange request,
     * * set the 2 posts to the Archive
     * * set the exchange request to it self and the exchange request to the other post to Archive
     * @param integer $rowId
     * @param integer $postId
     * @param integer $theOtherPostId
     * @return void
     */
    public static function acceptExchangeRequest($rowId, $postId, $theOtherPostId)
    {
        $recored = ExchangeRequest::find($rowId);
        $postHeader = Post::select('header')->where('id', $theOtherPostId)->get();
        $username = Post::find($postId)->user->name;
        DB::transaction(function () use ($rowId, $postId, $theOtherPostId, $recored, $postHeader, $username) {
            Post::moveToArchive([$postId, $theOtherPostId]);
            self::accepted($rowId, [$postId, $theOtherPostId]);
            $exchangeRequest = ExchangeRequest::find($rowId);
            $exchangeRequest->status = 'accepted';
            $exchangeRequest->save();
            $data = [
                'event' => 'exchangeRequestApprovedNotify',
                'data' => [
                    'userId' => $recored['owner_id'],
                    'postHeader' => $postHeader[0]->header,
                    'username' => $username,
                ],
            ];
            Redis::publish('notification', json_encode($data));
        });
        return response()->json([
            "message" => "You just accepted this exchange request",
            "action" => 'refresh',
        ]);
    }

    /**
     * delete the recored based on the id
     *
     * @param integer $rowId
     * @return string
     */
    public static function deleteExchangeRequest($rowId)
    {
        ExchangeRequest::destroy($rowId);
        return response()->json([
            "message" => "request deleted !",
        ]);
    }

    /**
     * getting each recored and setting the status to accepted
     * @param array $exchangeRequestsIds
     * @return void
     */
    private static function accepted($rowId, $exchangeRequestsIds)
    {
        foreach ($exchangeRequestsIds as $id) {
            $exchangeRequest = ExchangeRequest::where([
                'user_post_id' => $id,
            ])->orWhere([
                'owner_post_id' => $id,
            ])->where([
                'status' => 'pending',
            ])->get();
            foreach ($exchangeRequest as $recored) {
                $recored->status = 'removed';
                $recored->save();
            }
        }
        $er = ExchangeRequest::find($rowId);
        $er->status = 'accepted';
        $er->save();
    }

    /**
     *
     *
     * @param integer $userId
     * @return void
     */
    public static function exchangeRequestsProfile(int $userId)
    {
        $peopleToReview = ExchangeRequest::with('onwer')->with('user')->where([
            'owner_id' => $userId,
            'status' => 'accepted',
        ])->orWhere(function ($q) use ($userId) {
            $q->where([
                'user_id' => $userId,
                'status' => 'accepted',
            ]);
        })->take(10)->get();
        return $peopleToReview;
    }

    /**
     *
     *
     * @return void
     */
    public static function getPeopleToReview()
    {

        $peopleToReview = DB::table('exchange_requests')
            ->select('user.name as user_name', 'user.id as user_id', DB::raw('count(reviews.id) as review_count'))
            ->join('users as user', 'user.id', '=', 'exchange_requests.user_id')
            ->join('users as onwer', 'onwer.id', '=', 'exchange_requests.owner_id')
            ->leftJoin('reviews', 'reviews.from_id', '=', 'exchange_requests.owner_id')
            ->where('onwer.id', Auth()->user()->id)
            ->groupBy('user.name', 'user.id')
            ->having('review_count', 0)
            ->union(
                DB::table('exchange_requests')
                    ->select('onwer.name as user_name', 'onwer.id as user_id', DB::raw('count(reviews.id) as review_count'))
                    ->join('users as user', 'user.id', '=', 'exchange_requests.user_id')
                    ->join('users as onwer', 'onwer.id', '=', 'exchange_requests.owner_id')
                    ->leftJoin('reviews', 'reviews.user_id', '=', 'exchange_requests.user_id')
                    ->where('user.id', Auth()->user()->id)
                    ->groupBy('onwer.name', 'onwer.id')
                    ->having('review_count', 0)
            )->get()->toArray();
        return $peopleToReview;
    }
}

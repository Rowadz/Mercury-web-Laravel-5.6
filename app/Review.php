<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Mercury\User;

class Review extends Model
{

    public function user()
    {
        return $this->belongsTo("Mercury\User", 'user_id');
    }

    public function onwer()
    {
        return $this->belongsTo("Mercury\User", 'from_id');
    }

    /**
     *
     * @param integer $theUserWhoReviewed
     * @param integer $userId
     * @return boolean
     */
    public static function isReviewed(int $theUserWhoReviewed, int $userId): bool
    {
        $idReviewed = Review::where([
            'from_id' => $theUserWhoReviewed,
            'user_id' => $userId,
        ])->get();

        return $idReviewed === null ? true : false;
    }

    /**
     *
     * @param integer $userId
     * @param string $type
     * @param string $header
     * @param string $body
     * @return void
     */
    public static function addReview(int $userId, string $type, string $header, string $body)
    {
        $review = new Review;
        $review->user_id = $userId;
        $review->from_id = Auth()->user()->id;
        $review->header = $header;
        $review->body = $body;
        if (!$review->save()) {
            return response()->json(['error' => 'something went wrong'], 500);
        }

        return response()->json([
            'message' => 'created the review',
        ], 200);
    }

    /**
     *
     * 
     * @param User $user
     * @return void
     */
    public static function reviewDataCount(User $user)
    {
        $happy = Review::where([
            'value' => 'happy',
            'user_id' => $user->id,
        ])->count();
        $sad = Review::where([
            'value' => 'sad',
            'user_id' => $user->id,
        ])->count();
        $angry = Review::where([
            'value' => 'angry',
            'user_id' => $user->id,
        ])->count();
        return compact('happy', 'sad', 'angry');
    }
}

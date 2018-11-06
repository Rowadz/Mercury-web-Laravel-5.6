<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
 
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
            'user_id' => $userId
        ])->get();

        return $idReviewed === null ? true : false;
    }

    public static function addReview(int $userId, string $type, string $header, string $body)
    {
        $review = new Review;
        $review->user_id = $userId;
        $review->from_id = Auth()->user()->id;
        $review->header = $header;
        $review->body = $body;
    }
}

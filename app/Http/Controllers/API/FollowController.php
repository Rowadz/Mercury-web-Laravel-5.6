<?php

namespace Mercury\Http\Controllers\API;

use Mercury\Follower;
use Mercury\Http\Controllers\Controller;

class FollowController extends Controller
{
    public function followers(int $id)
    {
        return response()->json(
            Follower::with('user')->where([
                'user_id' => $id,
                'status' => 'approved',
            ])->orderBy('created_at')->get()
        );
    }

    public function following(int $id)
    {
        return response()->json(
            Follower::with('otherUser')->where([
                'from_id' => $id,
                'status' => 'approved',
            ])->orderBy('created_at')->get()
        );
    }
}

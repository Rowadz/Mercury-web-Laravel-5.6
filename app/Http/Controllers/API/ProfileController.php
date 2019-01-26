<?php

namespace Mercury\Http\Controllers\API;

use Illuminate\Http\Request;
use Mercury\Follower;
use Mercury\Http\Controllers\Controller;
use Mercury\User;

class ProfileController extends Controller
{
    public function getUser(int $id, int $currId)
    {

        return response()->json([
            "user" => User::find($id),
            'followers' => Follower::followersProfile($id),
            'following' => Follower::followingProfile($id),
            "status" => Follower::iamI($id, $currId),
        ]);
    }

    public function follow(Request $req)
    {
        return response()->json(Follower::followUserAPI($req->userId, $req->fromId));
    }

    public function deleteFollow(int $rowId)
    {
        return response()->json(Follower::deleteFollow($rowId));
    }
}

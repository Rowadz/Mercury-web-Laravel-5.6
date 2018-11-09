<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Mercury\User;
use Mercury\Follower;


class Follower extends Model
{ 
    /**
     * each recored belongsTo one user ~ the onwer
     *
     * @return void
     */  
    public function user()
    {
        return $this->belongsTo("Mercury\User", "from_id");
    }

    /**
     * each recored belongsTo one user ~ the receiver
     *
     * @return void
     */
    public function otherUser()
    {
        return $this->belongsTo("Mercury\User", "user_id");
    }

    /**
     * getting the number of followers for the logged in user
     *
     * @return integer
     */
    public static function allFollowers()
    {
    	return Follower::where([
            'user_id' => isset(Auth()->user()->id)?Auth()->user()->id:null,
            'status' => 'approved'
        ])->get()->count();
    }


    /**
     * infinite scroll for follower
     *
     * @param any $highestId
     * @return void
     */
    public static function seeFollowers($highestId = null)
    {
        return Follower::with('user')->where([
                                'user_id' => Auth()->user()->id,
                                'status' => 'approved',
                            ])->where('id' ,'>', $highestId ?: 0)
                            ->orderBy('id')
                            ->take(10)->get();
    }



    /**
     * getting the people that follow the authed user 
     * @param integer $highestId
     * @return void
     */
    public static function seeTheUsersYouAreFollowing(int $highestId = null)
    {
        $following = Follower::where([
            'from_id' => Auth()->user()->id,
            'status' => 'approved'
        ])->where('id', '>' , $highestId ?: 0)
            ->orderBy('id')
            ->take(10)
            ->get();
        $sizeofFollowingArray = sizeof($following);
        for ($i=0; $i <  $sizeofFollowingArray; $i++) $following[$i]['user'] = User::find($following[$i]->user_id)->toArray();
        return $following;
    }


    /**
     * getting the people that the authed user follow
     *
     * @return void
     */
    public static function allFollowedByTheUser()
    {
        return Follower::where([
            'from_id' => isset(Auth()->user()->id)?Auth()->user()->id:null,
            'status' => 'approved'
        ])->get()->count();
    }

    /**
     * getting how many follow requests
     *
     * @return void
     */
    public static function followRequestsCount()
    {
        return isset(Auth()->user()->id) ? Follower::where([
            'user_id' => Auth()->user()->id,
            'status' => 'pending'
        ])->count() :  null;
    }
    
    /**
     * getting the follow requests
     *
     * @return void
     */
    public static function allRequests()
    {
        try{
            $userSentRequest = Follower::with('user')->where([
                'user_id' => Auth()->user()->id,
                'status' => 'pending'
            ])->get();
            $users = [];
            foreach ($userSentRequest as $user) {
                array_push($users, $user);
            }
            return $users;
            // return Follower::where([
            //     'user_id' => Auth()->user()->id,
            //     'status' => 0
            // ])->get();
        }catch (Exception $e){
            return response()->json([
                'serverError' => "Something went wrong"
            ]);
        }
    }

    /**
     * changing the recored status to approved
     *
     * @param integer $id
     * @return void
     */
    public static function approve(int $id)
    {
        $follower = self::checkIfFollowRequestExistInTheDataBase($id);
        if(!empty($follower) && ($follower->user_id === Auth()->user()->id)){
            $follower->status = 'approved';
            $follower->save();
            return response()->json([
                'success' => 'You accepted the follow request from '
            ]);
        } else return response()->json(['error' => 'not a valid request' ]);
    }

    /**
     * delete the recored 
     *
     * @param integer $id
     * @return void
     */
    public static function decline(int $id)
    {
        $follower = self::checkIfFollowRequestExistInTheDataBase($id);
        if( ! empty($follower) && ($follower->user_id === Auth()->user()->id)){
            $follower->delete();
            return response()->json([
                'success' => 'You declined the follow request from '
            ]);
        } else return response()->json(['error' => 'not a valid request']);
    }

    /**
     * checking if the request already exists
     *
     * @param integer $id
     * @return void
     */
    private static function checkIfFollowRequestExistInTheDataBase(int $id)
    {
        return Follower::where([
            'user_id' => Auth()->user()->id,
            'from_id' => $id,
            'status' => 'pending'
        ])->first();
    }

    /**
     * getting the recored id
     *
     * @param integer $id
     * @return void
     */
    public static  function getRowId(int $id)
    {
        return Follower::where("from_id", Auth()->user()->id)->
               where("user_id", $id)->
               first()->id;
    }

    /**
     * delete the recored
     *
     * @param integer $id
     * @return boolean
     */
    public static function cancel(int $id)
    {
        // deleting the follow request by column id
        $follower = Follower::find($id);
        if($follower->from_id === Auth()->user()->id && $follower){
            $follower->delete();    
            return true;
        }
        return false;  
    }

    /**
     *
     * checking is the current loged-in user sent a follow request to this user
     * if not (empty) just send one
     * @param integer $user_id
     * @return void
     */
    public static function followUser(int $user_id)
    {
        if(empty(Follower::where([
                    'from_id' => isset(Auth()->user()->id) ? Auth()->user()->id : null,
                    'user_id' => $user_id
                ])->first())){
            $follower = new Follower;
            $follower->from_id = Auth()->user()->id;
            $follower->user_id = $user_id;
            $follower->status = 'pending';
            $follower->save();
            return true;
        }
        return false;
    }

    /**
     * deleting the recored
     *
     * @param integer $id
     * @return void
     */
    public static function unfollowUser(int $id)
    {
        // just deleting the row
        return self::cancel($id);
    }



    /**
     * checking if the authed user follwing the other user being viewed 
     *
     * @param integer $id
     * @return void
     */
    public static function iamIFollowingThisUser(int $id)
    {
        if($id !== Auth()->user()->id){
            $data = Follower::where([
                'from_id' => isset(Auth()->user()->id) ? Auth()->user()->id :  null,
                'user_id' => $id
            ])->first();
            if(isset($data)){
                if($data->status === 'pending') return 'canCancel';
                else if($data->status === 'approved') return 'canUnfollow';
            }else return 'notFollowing';
        }
        else return null;
    }

    
    /**
     * getting how many followers a user had
     * ~ for the profile page
     *
     * @param integer $userId
     * @return void
     */
    public static function followersProfile(int $userId)
    {
        return Follower::where([
            'user_id' => $userId,
            'status' => 'approved'
        ])->count();
    }

    /**
     * getting the many users a user had
     * ~ for the profille page
     *
     * @param integer $userId
     * @return void
     */
    public static function followingProfile(int $userId)
    {
        return Follower::where([
            'from_id' => $userId,
            'status' => 'approved'
        ])->count();
    }

    /**
     * getting the follow history
     *
     * @param integer $userId
     * @return void
     */
    public static function followingFeedProfile(int $userId)
    {
        $data =  Follower::with('user')->with('otherUser')->where([
            'status' => 'approved',
            'user_id' => $userId
        ])->orWhere(function($q) use($userId) {
            $q->where([
                'from_id' => $userId,
                'status' => 'approved'
            ]);
        })->orderBy('created_at')->take(10)->get();
        return $data;   
    }

}

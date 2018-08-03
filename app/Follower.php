<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Mercury\User;
use Mercury\Follower;

        // status
        // 0 => requested 
        // 1 => approved 

class Follower extends Model
{   
	public function user(){
        return $this->belongsTo("Mercury\\User", "from_id");
    }

    public static function allFollowers(){
    	return Follower::where('user_id', isset(Auth()->user()->id)?Auth()->user()->id:null)->where("status", 1)->get()->count();
    }


    public static function seeFollowers(){
        return Follower::where('user_id', Auth()->user()->id)->where("status", 1)->get();
    }


    public static function seeTheUsersYouAreFollowing(){
        $x = Follower::where('from_id', Auth()->user()->id)->where("status", 1)->get();
        $users = [];
        foreach ($x as $value) 
            array_push($users, User::find($value->user_id));
        return $users;
    }


    public static function allFollowedByTheUser(){
    	return Follower::where('from_id', isset(Auth()->user()->id)?Auth()->user()->id:null)->where('status', 1)->get()->count();
    }

    public static function followRequestsCount(){
        return isset(Auth()->user()->id) ? Follower::where([
            'user_id' => Auth()->user()->id,
            'status' => 0
        ])->count() :  null;
    }

    // the users who sent a follow reuest to the auth user
    // public static function newFollowerRequestedName(){
    // 	$newFollowers =  Follower::where("user_id", Auth()->user()->id)->where("status", 0)->get();
    // 	$oldFollowers = Follower::where("user_id", Auth()->user()->id)->where("status", 2)->get();
    // 	$returnFollowers = $newFollowers;
    // 	foreach ($newFollowers as $follower) {
    // 		$follower->status = 2;
    // 		$follower->save();
    // 	}
    // 	return response()->json([
    // 		"newFollowers" => $returnFollowers,
    // 		"oldFollowers" => $oldFollowers
    // 	]);
    // }
    public static function allRequests(){
        try{
            $userSentRequest = Follower::with('user')->where([
                'user_id' => Auth()->user()->id,
                'status' => 0
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

    public static function approve($id){
        $follower = self::checkIfFollowRequestExistInTheDataBase($id);
        if( ! empty($follower) && ($follower->user_id === Auth()->user()->id)){
            try{
                $follower->status = 1;
                $follower->save();
                return response()->json([
                    'success' => 'You accepted the follow request from '
                ]);
            }catch(Exception $e){
                return response()->json([
                    'error' => 'something went wrong'
                ]);
            }
        } else return response()->json([
            'error' => 'not a valid request'
        ]);
    }

    public static function decline($id){
        $follower = self::checkIfFollowRequestExistInTheDataBase($id);
        if( ! empty($follower) && ($follower->user_id === Auth()->user()->id)){
            try{
                $follower->delete();
                return response()->json([
                    'success' => 'You declined the follow request from '
                ]);
            }catch(Exception $e){
                return response()->json([
                    'error' => 'something went wrong'
                ]);
            }
        } else return response()->json([
            'error' => 'not a valid request'
        ]);
    }

    private static function checkIfFollowRequestExistInTheDataBase($id){
        return Follower::where([
            'user_id' => Auth()->user()->id,
            'from_id' => $id,
            'status' => 0
        ])->first();
    }

    public static  function getRowId($id){
        return Follower::where("from_id", Auth()->user()->id)->
               where("user_id", $id)->
               first()->id;
    }

    public static function unFollow($id){
        $follower = Follower::where("from_id", Auth()->user()->id)->where("user_id", $id);
        $follower->delete();
        return "Deleted!";
    }

    public static function cancel($id){
        // deleting the follow request by column id
        $follower = Follower::find($id);
        if($follower->from_id === Auth()->user()->id && $follower){
            $follower->delete();    
            return true;
        }else {
            // TODO return false
            return true;
        }
        
    }

    public static function followUser($user_id){
        // checking is the current loged-in user sent a follow request to this user
        // if not (empty) just send one
        if(empty(Follower::where([
                    'from_id' => isset(Auth()->user()->id) ? Auth()->user()->id : null,
                    'user_id' => $user_id
                ])->first())){
            // dd("??");
            $follower = new Follower;
            $follower->from_id = Auth()->user()->id;
            $follower->user_id = $user_id;
            $follower->status = 0;
            $follower->save();
            return true;
        }else{
            // dd("💘");
        }
        return false;
    }

    public static function unfollowUser($id){
        // just deleting the row
        return self::cancel($id);
    }



    public static function iamIFollowingThisUser($id){
        
        if($id !== Auth()->user()->id){
            $data = Follower::where([
                'from_id' => isset(Auth()->user()->id) ? Auth()->user()->id :  null,
                'user_id' => $id
            ])->first();
            if(!empty($data))
                return $data->status;
            else return false;
        }
        else return null;
    }

    public static function followersProfile($userId){
        return Follower::where([
            'user_id' => $userId,
            'status' => 1
        ])->count();
    }

    public static function followingProfile($userId){
        return Follower::where([
            'from_id' => $userId,
            'status' => 1
        ])->count();
    }
}

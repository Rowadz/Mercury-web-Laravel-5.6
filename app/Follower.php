<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Mercury\User;

        // status
        // 0 => requested 
        // 1 => approved 
        // 2 => read from and displayed as a notification

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

    // the users who sent a follow reuest to the auth user
    public static function newFollowerRequestedName(){
    	$newFollowers =  Follower::where("user_id", Auth()->user()->id)->where("status", 0)->get();
    	$oldFollowers = Follower::where("user_id", Auth()->user()->id)->where("status", 2)->get();
    	$returnFollowers = $newFollowers;
    	foreach ($newFollowers as $follower) {
    		$follower->status = 2;
    		$follower->save();
    	}
    	return response()->json([
    		"newFollowers" => $returnFollowers,
    		"oldFollowers" => $oldFollowers
    	]);
    }
    public static function allRequests(){
    	$newFollowers =  Follower::where("user_id", Auth()->user()->id)
    	->where("status", 0)->orWhere("status", 2)->where("user_id", Auth()->user()->id)->get();
    	return $newFollowers;
    }

    public static function approve($id){
        // The user can type the js function name & change the values in the table
        // FIXED
        // by checking if the follow request actually is for the 'Authed' user
        $follower = Follower::find($id);
        if($follower->user_id === Auth()->user()->id){
            $follower->status = 1;
            $follower->save();
            return "Approved!";
        }else{
            return "not a valid request";
        }
        
    }

    public static function decline($id){
        $follower = Follower::find($id);
        if($follower->user_id === Auth()->user()->id){
            $follower->delete();
            return "Declined!";
        }else{
            return "not a valid request";
        }
  
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
        if(User::find($user_id)){
            $follower = new Follower;
            $follower->from_id = Auth()->user()->id;
            $follower->user_id = $user_id;
            $follower->status = 0;
            $follower->save();
            return true;
        }else{
            // TODO return false
            return true;
        }
    }

    public static function unfollowUser($id){
        // just deleting the row
        return self::cancel($id);
    }



    public static function iamIFollowingThisUser($id){
        
        if($id !== Auth()->user()->id){
            $data = Follower::where("from_id", isset(Auth()->user()->id)?Auth()->user()->id:null)->
                    where("user_id", $id)->
                    first();
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

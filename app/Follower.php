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
    	return Follower::where([
            'user_id' => isset(Auth()->user()->id)?Auth()->user()->id:null,
            'status' => 1
        ])->get()->count();
    }


    public static function seeFollowers($highestId = null){
        return Follower::with('user')->where([
                                'user_id' => Auth()->user()->id,
                                'status' => 1,
                            ])->where('id' ,'>', $highestId ?: 0)
                            ->orderBy('id')
                            ->take(10)->get();
    }


    public static function seeTheUsersYouAreFollowing($highestId = null){
        $following = Follower::where([
            'from_id' => Auth()->user()->id,
            'status' => 1
        ])->where('id', '>' , $highestId ?: 0)
            ->orderBy('id')
            ->take(10)
            ->get();
        $sizeofFollowingArray = sizeof($following);
        for ($i=0; $i <  $sizeofFollowingArray; $i++) $following[$i]['user'] = User::find($following[$i]->user_id)->toArray();
        return $following;
    }


    public static function allFollowedByTheUser(){
        return Follower::where([
            'from_id' => isset(Auth()->user()->id)?Auth()->user()->id:null,
            'status' => 1
        ])->get()->count();
    }

    public static function followRequestsCount(){
        return isset(Auth()->user()->id) ? Follower::where([
            'user_id' => Auth()->user()->id,
            'status' => 0
        ])->count() :  null;
    }
    
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

    // public static function unFollow($id){
    //     $follower = Follower::where("from_id", Auth()->user()->id)->where("user_id", $id);
    //     $follower->delete();
    //     return "Deleted!";
    // }

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

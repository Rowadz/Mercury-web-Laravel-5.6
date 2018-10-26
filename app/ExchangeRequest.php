<?php

namespace Mercury;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mercury\PostImage;
use Mercury\Post;
// user_id  who sent the request
// post_id  the offerd Post
// original_post_id  the The post that recived an exchange request
// status => 1 accepted 
// status => 0 pending 
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
        return $this->belongsTo("Mercury\User");
    }

    /**
     * each recored in the exhange request table
     * will belong to one post through the original_post_id
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo("Mercury\Post", "original_post_id");
    }

    public function otherPost(){
        return $this->belongsTo("Mercury\Post", "post_id");
    }

    /**
     * getting how many exchange requests was sent to the user
     * 
     * @return integer|null
     */
    public static function exchangeRequestCount()
    {
        if(isset(Auth()->user()->id)){
            return ExchangeRequest::whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->where('status', 'pending')->count();
        } else return null;
    }

    /**
     * adding a recored ! 
     * 
     * @param integer $userPostId
     * @param integer $postId
     * @return void
     */
    public static function sendExchangeRequest($userPostId, $postId)
    {
        if(! ExchangeRequest::where([
            'user_id' => Auth()->user()->id,
            'post_id' => $postId,
            'original_post_id' => $userPostId,
            'status' => 'pending'
        ])->first()){
            $exchangeRequest = new ExchangeRequest();
            $exchangeRequest->user_id = Auth()->user()->id;
            $exchangeRequest->post_id = $postId;
            $exchangeRequest->original_post_id = $userPostId;
            $exchangeRequest->status = 'pending';
            $exchangeRequest->save();
            return response()->json([
                "message" => "Sent 🐵"
            ]);
        } else return response()->json([ "message" => "Already Sent!! 🙊🙊"]);
    }

    /**
     * getting the exchange request for the user
     *
     * @param boolean $DESC
     * @return array
     */
    public static function dataForTheExchangeRequstsView($DESC = true)
    {
        $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
            $q->where('user_id',  Auth()->user()->id);
        })->where('status', 'pending')->orderBy('id', ($DESC) ? 'DESC' :'ASC')->take(2)->get();
        
        foreach ($data as $key => $value) {
            $data[$key]["theOtherPost"] = Post::where([
                'user_id' => $value['user_id'],
                'id' => $value['post_id']
            ])->first();
        }
        return $data;   
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
        if($id !== null && isset($shouldItBeDESC)){
            $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->where('id', ($shouldItBeDESC === 'DESC') ? '<' : '>' , $id)->where('status', 'pending')->orderBy('id', ($shouldItBeDESC === 'DESC') ? 'DESC' : 'ASC')->take(2)->get();
        } else {
            $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->where('status', 'pending')->orderBy('id', (($shouldItBeDESC === 'DESC') ? 'DESC' : 'ASC'))->take(2)->get(); 
        }
        
        foreach ($data as $key => $value) {
            $data[$key]["theOtherPost"] = Post::where([
                'user_id' => $value['user_id'],
                'id' => $value['post_id']
            ])->first();
            $x = $data[$key]["theOtherPost"]->toarray();
            $xx = $data[$key]["post"]->toarray();
            $data[$key]->theOtherPost->imageLocation = PostImage::select('location')->where("post_id", $value['post_id'])->first()->location;
            $data[$key]->post->imageLocation = PostImage::select('location')->where("post_id", $value['original_post_id'])->first()->location;
            // you can do this as well !
            // $data[$key]['theOtherPost']['imageLocation'] = PostImage::select('location')->where("post_id", $value['post_id'])->first()->location;
            // $data[$key]["post"]['imageLocation'] = PostImage::select('location')->where("post_id", $value['original_post_id'])->first()->location;
        }
        return $data;   
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
        if(ExchangeRequest::where([
            'id' => $rowId,
            'post_id' => $theOtherPostId,
            'original_post_id' => $postId,
            'status' => 'pending'
        ])->first())
            return true;
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
        DB::transaction(function () use ($rowId, $postId, $theOtherPostId) {
            Post::moveToArchive([$postId, $theOtherPostId]);
            self::accepted([$postId, $theOtherPostId]);
            $exchangeRequest = ExchangeRequest::find($rowId);
            $exchangeRequest->status = 'accepted';
            $exchangeRequest->save();
        });
        return response()->json([
            "message" => "You just accepted this exchange request",
            "action" => 'refresh'
        ]);
    }

    /**
     * delete the recored based on the id
     *
     * @param integer $rowId
     * @return string
     */
    public static function deleteExchangeRequest($rowId){
        ExchangeRequest::destroy($rowId);
        return response()->json([
            "message" => "request deleted !"
        ]);
    }

    /**
     * getting each recored and setting the status to accepted
     * @param array $exchangeRequestsIds
     * @return void
     */
    private static function accepted($exchangeRequestsIds)
    {
        foreach($exchangeRequestsIds as $id){
            $exchangeRequest = ExchangeRequest::where([
                'post_id' => $id,
            ])->orWhere([
                'original_post_id' => $id,
            ])->where([
                'status' => 'pending'
            ])->get();
            foreach ($exchangeRequest as $recored) {
                $recored->status = 'accepted';
                $recored->save();
            }
        }
    }

    
    /**
     *
     *
     * @param integer $userId
     * @return void
     */
    public static function exchangeRequestsProfile(int $userId)
    {
        // $data =  ExchangeRequest::with('user')->with('post')
        //         ->with('otherPost')
        //         ->where('status', 'accepted')->orderBy('created_at')
        //         ->take(10)->get();
        $data = ExchangeRequest::where([
            'user_id' => $userId,
            'status' => 'accepted'
        ])->take(10)->orderBy('created_at')->get();

        $users = [];

        foreach ($data as $key => $value) {
            $postUser = Post::with('user')->find($value->original_post_id);
            array_push($users, $postUser->user);
        }
        // return $users;
        $theExhcnageRequestsSentToTheUser = ExchangeRequest::where('status', 'accepted')
                    ->where('user_id', '!=', $userId)->get();


        foreach ($theExhcnageRequestsSentToTheUser as $key => $value) {
            $postUser = Post::find($value->original_post_id);
            if($postUser->user_id === $userId){
                $user = User::find($value->user_id);
                array_push($users, $user);
            }
        }

        return $users;   
    }
    
    /**
     * TODO:: DESCRIPE THIS
     *
     * @return void
     */
    public static function getPeopleToReview()
    {
        // the request that sent to the user !
        $theExhcnageRequestsTheUserSent = ExchangeRequest::where([
            'user_id' => Auth()->user()->id,
            'status' => 'accepted'
        ])->get();
        
        $usersTheAuthedSentReqToThem = [];
        foreach ($theExhcnageRequestsTheUserSent as $key => $value) {
            $postUser = Post::with('user')->find($value->post_id);
            array_push($usersTheAuthedSentReqToThem, $postUser->user);
        }

        $theExhcnageRequestsSent = ExchangeRequest::where('status', 'accepted')
                    ->where('user_id', '!=', Auth()->user()->id)->get();

        foreach ($theExhcnageRequestsSent as $key => $value) {
            $postUser = Post::find($value->original_post_id);
            if($postUser->user_id === Auth()->user()->id){
                $userToReview = User::find($value->user_id);
                array_push($usersTheAuthedSentReqToThem, $userToReview);
            }
        }
        $finalUsers = [];

        foreach ($usersTheAuthedSentReqToThem as $key => $value) {
            if(!Review::isReviewed(Auth()->user()->id, $value->id))
                array_push($finalUsers, $value);                
        }
        return view('user.peopleToReview')->with('finalUsers', $finalUsers);
    }
}

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
// status => 2 archive
class ExchangeRequest extends Model
{
    // who sent the request
    public function user()
    {
        return $this->belongsTo("Mercury\User");
    }

    // post_id
    public function post()
    {
        return $this->belongsTo("Mercury\Post", "original_post_id");
    }

    public static function exchangeRequestCount()
    {
        if(isset(Auth()->user()->id)){
            return ExchangeRequest::whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->where('status', 0)->count();
        } else return null;
    }

    public static function sendExchangeRequest($userPostId, $postId)
    {
        try{
            if(! ExchangeRequest::where([
                'user_id' => Auth()->user()->id,
                'post_id' => $postId,
                'original_post_id' => $userPostId,
                'status' => 0
            ])->first()){
                $exchangeRequest = new ExchangeRequest();
                $exchangeRequest->user_id = Auth()->user()->id;
                $exchangeRequest->post_id = $postId;
                $exchangeRequest->original_post_id = $userPostId;
                $exchangeRequest->status = 0;
                $exchangeRequest->save();
                return response()->json([
                    "message" => "Sent 🐵"
                ]);
            } else return response()->json([ "message" => "Already Sent!! 🙊🙊"]);    
            

        } catch (Exception $e) {
            return response()->json([
                "message" => "Something Went Bad 🤖"
            ]);
        }
    }

    public static function dataForTheExchangeRequstsView($DESC = true)
    {
        try{
            $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->where('status', 0)->orderBy('id', ($DESC) ? 'DESC' :'ASC')->take(2)->get();
            
            foreach ($data as $key => $value) {
                $data[$key]["theOtherPost"] = Post::where([
                    'user_id' => $value['user_id'],
                    'id' => $value['post_id']
                ])->first();
            }
            return $data;   
            // dd($data);
        }catch(Exception $e){
            abort(500);
        }
    }

    public static function loadMore($id = null, $shouldItBeDESC)
    {
        try{
            if($id !== null && isset($shouldItBeDESC)){
                $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                    $q->where('user_id',  Auth()->user()->id);
                })->where('id', ($shouldItBeDESC === 'DESC') ? '<' : '>' , $id)->where('status', 0)->orderBy('id', ($shouldItBeDESC === 'DESC') ? 'DESC' : 'ASC')->take(2)->get();
            } else {
                $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                    $q->where('user_id',  Auth()->user()->id);
                })->where('status', 0)->orderBy('id', (($shouldItBeDESC === 'DESC') ? 'DESC' : 'ASC'))->take(2)->get(); 
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
        }catch(Exception $e){
            return response()->json([
                "message" => "Something Went Bad 🤖"
            ]);
        }
    }

    public static function checkIfExchangeRequestExist($rowId, $postId, $theOtherPostId)
    {
        if(ExchangeRequest::where([
            'id' => $rowId,
            'post_id' => $theOtherPostId,
            'original_post_id' => $postId,
            'status' => 0
        ])->first())
            return true;
        return false;    
    }

    public static function acceptExchangeRequest($rowId, $postId, $theOtherPostId)
    {   
        DB::transaction(function () use ($rowId, $postId, $theOtherPostId) {
            Post::moveToArchive([$postId, $theOtherPostId]);
            self::moveToArchive([$postId, $theOtherPostId]);
            $exchangeRequest = ExchangeRequest::find($rowId);
            $exchangeRequest->status = 1;
            $exchangeRequest->save();
        });
        // refresh the page 
        return response()->json([
            "message" => "You just accepted this exchange request",
            "action" => 'refresh'
        ]);
    }

    public static function deleteExchangeRequest($rowId){
        ExchangeRequest::destroy($rowId);
        return response()->json([
            "message" => "request deleted !"
        ]);
    }

    private static function moveToArchive($exchangeRequestsIds)
    {
        foreach($exchangeRequestsIds as $id){
            $x = ExchangeRequest::where([
                'post_id' => $id,
            ])->orWhere([
                'original_post_id' => $id,
            ])->where([
                'status' => 0
            ])->get();
            foreach ($x as $exchangeRequest) {
                $exchangeRequest->status = 2;
                $exchangeRequest->save();
            }
        }
    }
}

<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Mercury\PostImage;
// user_id  who sent the request
// post_id  the offerd Post
// original_post_id  the The post that recived an exchange request
// status => 1 accepted 
// status => 0 pending 
class ExchangeRequest extends Model
{
    // who sent the request
    public function user(){
        return $this->belongsTo("Mercury\User");
    }

    // post_id
    public function post(){
        return $this->belongsTo("Mercury\Post", "original_post_id");
    }

    public static function exchangeRequestCount(){
        if(isset(Auth()->user()->id)){
            return ExchangeRequest::whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->count();
        } else return null;
    }
    public static function sendExchangeRequest($userPostId, $postId){
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
    public static function dataForTheExchangeRequstsView(){
        try{
            $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->orderBy('id','DESC')->take(2)->get();
            foreach ($data as $key => $value) {
                $data[$key]["theOtherPost"] = Post::where([
                    'user_id' => $value['user_id'],
                    'id' => $value['post_id']
                ])->first();
            }
            return $data;   
        }catch(Exception $e){
            abort(500);
        }
    }

    public static function loadMore($id){
        try{
            $data =  ExchangeRequest::with('post')->whereHas('post', function($q){
                $q->where('user_id',  Auth()->user()->id);
            })->where('id', '<', $id)->orderBy('id','DESC')->take(2)->get();
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
}

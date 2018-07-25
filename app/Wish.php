<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wish extends Model
{
    protected $fillable = [
        'user_id', 'post_id'
    ];

    public function post(){
        return $this->belongsTo("Mercury\\Post");
    }

    public static function getWishes(){
    	return Wish::where("user_id", isset(Auth()->user()->id)? Auth()->user()->id : null)->get()->count();
    }

    public static function create($id){
        if (! self::checkIfAlreadyCreated($id)) {
            $wish = new Wish();
            $wish->post_id = $id;
            $wish->user_id = Auth()->user()->id;
            $wish->save();
            return response()->json(["message" => "You just saved this post !"]);
        } else {
            return response()->json(["message" => "🤖 The post is already saved 🤖!"]);
        }
        
    }

    private static function checkIfAlreadyCreated($id){
        try{
            $wish = Wish::where([
                'user_id' => Auth()->user()->id,
                'post_id' => $id
            ])->first();
        }catch(Exception  $notFound){
            $wish = null;
        }
        return $wish;
    }
}

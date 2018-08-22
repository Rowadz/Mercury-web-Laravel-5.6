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

    public static function getWishesNumber(){
    	return Wish::where("user_id", isset(Auth()->user()->id)? Auth()->user()->id : null)->get()->count();
    }

    public static function create($id){
        if (! self::checkIfAlreadyCreated($id)) {
            try{
                $wish = new Wish();
                $wish->post_id = $id;
                $wish->user_id = Auth()->user()->id;
                $wish->save();
                return response()->json(["message" => "You just saved this post !"]);
            } catch(Exception $e){
                return response()->json(["message" => "Something went wrong 🤖!"]);
            }
        } else {
            return response()->json(["message" => "🤖 The post is already saved 🤖!"]);
        }
    }

    public static function deleteWish($id){
        try{
            Wish::where([
                'user_id' => Auth()->user()->id,
                'post_id' => $id
            ])->first()->delete();
            return response()->json(["message" => "The Wish has been deleted"]);
        } catch (Exception $e){
            return response()->json(["message" => "Something went wrong 🤖"]);
        }
    }
    
    public static function getWishes($lowestId = null){
        try{
            return Wish::with('post.postImages')->where([
                'user_id' => Auth()->user()->id
            ])
            ->where('id', '<', $lowestId ?: 999999)
                ->orderBy('id', 'DESC')
                    ->take(5)
                        ->get();
        } catch(Exception $e){
            return response()->json(["message" => "Something went wrong 🤖"]);
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

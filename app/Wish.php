<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wish extends Model
{
    protected $fillable = [
        'user_id', 'post_id'
    ];

    /**
     * each post belongs to one wish
     * through post_id
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo("Mercury\Post");
    }

    /**
     * getting how many wishes the authed user have 
     * used in the AppServiceProvider CLASS
     *
     * @return integer
     */
    public static function getWishesNumber()
    {
    	return Wish::where("user_id", isset(Auth()->user()->id)? Auth()->user()->id : null)->get()->count();
    }

    /**
     * create new recored
     *
     * @param integer $id
     * @return void
     */
    public static function create($id)
    {
        if (! self::checkIfAlreadyCreated($id)) {
            $wish = new Wish();
            $wish->post_id = $id;
            $wish->user_id = Auth()->user()->id;
            $wish->save();
            return response()->json(["message" => "You just saved this post !"]);
        } else return response()->json(["message" => "🤖 The post is already saved 🤖!"]);
    }

    /**
     * deleting a recored
     *
     * @param integer $id
     * @return void
     */
    public static function deleteWish($id)
    {
        Wish::where([
            'user_id' => Auth()->user()->id,
            'post_id' => $id
        ])->first()->delete();
        return response()->json(["message" => "The Wish has been deleted"]);
    }
    
    /**
     * getting the wishes from an id,
     * 
     *
     * @param integer $lowestId
     * @return void
     */
    public static function getWishes($lowestId = null)
    {
            return Wish::with('post.postImages')->where([
                'user_id' => Auth()->user()->id
            ])
            ->where('id', '<', $lowestId ?: 999999)
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();
    }

    /**
     * just checking if the wish already made
     * 
     * @param integer $id
     * @return Wish $wish
     */
    private static function checkIfAlreadyCreated($id)
    {
        $wish = Wish::where([
            'user_id' => Auth()->user()->id,
            'post_id' => $id
        ])->first();
        return $wish;
    }
}

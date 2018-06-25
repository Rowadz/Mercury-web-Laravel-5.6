<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

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
}

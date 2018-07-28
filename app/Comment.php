<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post(){
        return $this->belongsTo("Mercury\\Post");
    }

    public function user(){
        return $this->belongsTo("Mercury\\User");
    }

    public static function create($postId, $comment){
        try {
            $theComment = new Comment;
            $theComment->user_id = Auth()->user()->id;
            $theComment->post_id = $postId;
            $theComment->body = strip_tags($comment);
            $theComment->save();
            return true;
        } catch(Exception $e){
            return false;
        }   
    }
}

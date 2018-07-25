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
            $comment = new Comment;
            $comment->user_id = Auth()->user()->id;
            $comment->post_id = $postId;
            $comment->body = strip_tags($comment);
            $comment->save();
            return true;
        } catch(Exception $e){
            return false;
        }   
    }
}

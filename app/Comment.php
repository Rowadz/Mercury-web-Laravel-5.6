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

    public static function create($id, $comment){
        try {
            $theComment = new Comment;
            $theComment->user_id = Auth()->user()->id;
            $theComment->post_id = $id;
            $theComment->body = $comment;
            $theComment->save();
            return response()->json(["message" => "Comment added"]);
        } catch(Exception $e){
            return response()->json(["message" => "Something went wrong"]);
        }   
    }

    public static function deleteComment($id){
        try{
            Comment::find($id)->delete();
            return response()->json(["success" => "The Comment has been deleted 🐵"]);
        } catch (Exception $e){
            return response()->json(["error" => "Something went wrong 🤖"]);
        }
    }

    public static function edit($id, $newComment){
        return null;
    }
}

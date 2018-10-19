<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * each comment belongs to one post
     * through the post_id
     * @return void
     */
    public function post()
    {
        return $this->belongsTo("Mercury\Post");
    }

    /**
     * each comment belongs to one user
     * through the post_id
     * @return void
     */
    public function user()
    {
        return $this->belongsTo("Mercury\User");
    }

    /**
     * creating a new recored
     *
     * @param integer $id
     * @param string $comment
     * @return void
     */
    public static function create($id, $comment)
    {
        $theComment = new Comment;
        $theComment->user_id = Auth()->user()->id;
        $theComment->post_id = $id;
        $theComment->body = $comment;
        $theComment->save();
        return response()->json(["message" => "Comment added"]);
    }


    /**
     * deleting a recored
     *
     * @param integer $id
     * @return void
     */
    public static function deleteComment($id)
    {
        Comment::find($id)->delete();
        return response()->json(["success" => "The Comment has been deleted 🐵"]);
    }

    /**
     * TODO :: make this work
     *
     * @param integer $id
     * @param integer $newComment
     * @return void
     */
    public static function edit($id, $newComment)
    {
        return null;
    }
}

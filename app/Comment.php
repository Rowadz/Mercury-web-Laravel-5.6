<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
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
        $data = [
            'event' => 'newComment',
            'data' => $theComment
        ];
        if($theComment->save()){
            Redis::publish('new-comment', json_encode($data));
            $notification = [
                'event' => 'newCommentNotify',
                'data' => [
                    'username' => Auth()->user()->name,
                    'userId' => $theComment->post->user_id,
                    'commentUserId' => Auth()->user()->id,
                    'postId' => $theComment->post_id,
                    'postHeader' => $theComment->post->header
                ]
            ];
            Redis::publish('notification', json_encode($notification));
            return response()->json(["message" => "Comment added"]);
        } else response()->json(["message" => "Something went wrong"]);
        
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

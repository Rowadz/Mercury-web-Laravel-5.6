<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'tag_id', 'header', 'body', 'location', 'quantity', 'status', 'video_link'
    ];
    public function postImages(){
        return $this->hasMany('Mercury\PostImage');
    }
    public function tag(){
        return $this->belongsTo("Mercury\\tag");
    }
    public function comments(){
        return $this->hasMany("Mercury\\Comment");
    }
    public function user(){
        return $this->belongsTo("Mercury\\User");
    }
    public function wishes(){
        return $this->hasMany("Mercury\\Wish");
    }

    public static function tenPosts(){
        return Post::where('status', 1)->orderBy('created_at')->take(10)->get();
    }

    public static function loadMorePosts($id){
        $posts = Post::where('status', 1)->where('id', '>',$id)->orderBy('created_at')->take(10)->get();
        $commentNumber = [];
        $tagNames = [];
        $users = [];
        $imageLocation = [];
        foreach ($posts as $key => $post) {
            $commentNumber[$key] = $post->comments->count();
            $tagNames[$key] = $post->tag->name;
            $users[$key] = $post->user->name;
            foreach ($post->postImages as $image){
                $imageLocation[$key] = $image->location;
                break;
            }
        }
        return response()->json(["posts" => $posts,
            "commentNumber" => $commentNumber,
            "tagNames" => $tagNames,
            'users' => $users,
            'imageLocation' => $imageLocation]);
    }

}

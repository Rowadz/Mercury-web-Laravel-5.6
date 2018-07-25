<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;


//  Available posts => status = 1
//  Archived  posts => status = 0

class Post extends Model
{
    // for mass assigment
    protected $fillable = [
        'user_id', 'tag_id', 'header', 'body', 'location', 'quantity', 'status', 'video_link'
    ];
    // setting realtionships
    
    // One Post has many postimage
    public function postImages(){
        return $this->hasMany('Mercury\PostImage');
    }

    // one post have one tag
    public function tag(){
        return $this->belongsTo("Mercury\\tag");
    }

    // one post has many comments
    public function comments(){
        return $this->hasMany("Mercury\\Comment");
    }

    // one post has one user
    public function user(){
        return $this->belongsTo("Mercury\\User");
    }

    // one post can be wished many times
    public function wishes(){
        return $this->hasMany("Mercury\\Wish");
    }

    
    public static function tenPosts(){
        return Post::where('status', 1)
                    ->orderBy('created_at', 'DESC')
                    ->take(10)
                    ->get();
    }

    // default, when the page loaded
    // Date descending order  
    // Available posts
    public static function tenPostsForAUser($user_id){
        return Post::where('status', 1)->
        where('user_id', $user_id)->
        orderBy('created_at', 'DESC')->
        paginate(10);
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
    
    public static function sortPosts($availableOrArchived, $sortOption, $userId){
        // Available Posts = $availableOrArchived = 1
        // Archived Posts = $availableOrArchived = 0
        // Date descending order  = $sortOption = 0
        // Date ascending order = $sortOption = 1
        // Number of comments $sortOption = 2
        switch ($sortOption) {
            case 0:
                // Date descending order  
                return Post::where('status', $availableOrArchived)->
                            where('user_id', $userId)->
                            orderBy('created_at', 'DESC')->
                            paginate(10); // default, when the page loaded
                break;
            case 1:
                // Date ascending order
                return Post::where('status', $availableOrArchived)->
                            where('user_id', $userId)->
                            orderBy('created_at')->
                            paginate(10);
                break;
            case 2:
                // Number of comments
                // I did this move because we can't access the $availableOrArchived inside the closure function
                // if($availableOrArchived === 1) return self::sortComments($userId);
                // else return self::sortComments($userId);
                return self::sortComments($userId, ($availableOrArchived === 1) ? 1 : 0);
                break;
            default:
                // do nothing
                break;
        }
    }

    private static function sortComments($userId, $status){
        return Post::where(['user_id' => $userId, 'status' => $status])
                    ->withCount(['comments'])
                    ->orderBy('comments_count', 'DESC')
                    ->paginate(10);
    }

    // private static function commentPostSortAvailable($userId){ 
    //     return Post::where(['user_id'=> $userId, 'status' => 1])
    //                     ->withCount(['comments'])
    //                     ->orderBy('comments_count', 'DESC')
    //                     ->paginate(10);
    // }

    // private static function commentPostSortArchived($userId){
    //     return Post::where(['user_id' => $userId, 'status' => 0])
    //                 ->withCount(['comments'])
    //                 ->orderBy('comments_count', 'DESC')
    //                 ->paginate(10);
    // }

    // private static function commentPostSortAvailable($userId){ 
    //     return Post::where('user_id', $userId)->withCount(['comments'=> function ($query){
    //         $query->where('status', 1);
    //     }])->orderBy('comments_count', 'DESC')->paginate(10);
    // }

    // private static function commentPostSortArchived($userId){
    //     return Post::where('user_id', $userId)->withCount(['comments'=> function ($query){
    //         $query->where('status', 0);
    //     }])->orderBy('comments_count', 'DESC')->paginate(10);
    // }
}

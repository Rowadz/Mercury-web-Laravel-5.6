<?php

namespace Mercury;

use Illuminate\Database\Eloquent\Model;
use Mercury\Tag;

//  Available posts
//  Archived  posts

class Post extends Model
{
    // for mass assigment
    protected $fillable = [
        'user_id', 'tag_id', 'header', 'body', 'location', 'quantity', 'status', 'video_link'
    ];


    /**
     * 
     * One Post has many postimages 
     * through a postImages table
     * @return void
     */
    public function postImages()
    {
        return $this->hasMany('Mercury\PostImage');
    }

    /**
     * one post have one tag through tag_id
     * @return void
     */
    public function tag()
    {
        return $this->belongsTo("Mercury\Tag");
    }

    // 
    /**
     * one post has many comments through 
     * post_id in the comment table
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany("Mercury\Comment");
    }

    // 
    /**
     * one post has one user
     * through user_id
     * @return void
     */
    public function user()
    {
        return $this->belongsTo("Mercury\User");
    }

    /**
     * one post can be wished many times
     * through post_id in the wishes table
     *
     * @return void
     */
    public function wishes()
    {
        return $this->hasMany("Mercury\Wish");
    }

    /**
     * the post have many exhcange requests
     * through =>
     * * original_post_id => the onwer post
     * * post_id => the other post id 
     *
     * @return void
     */
    public function exchangeRequests()
    {
        return $this->hasMany("Mercury\ExchangeRequest");
    }
    
    /**
     * getting lastes 10 posts
     *
     * @return void
     */
    public static function tenPosts(){
        return Post::where('status', 'available')
                    ->orderBy('created_at', 'DESC')
                    ->take(10)
                    ->get();
    }

    
    /**
     * getting 10 posts for the profile
     * 
     *
     * @param integer $user_id
     * @return array
     */
    public static function tenPostsForAUser(int $user_id){
        return Post::where('status', 'available')->
        where('user_id', $user_id)->
        orderBy('created_at', 'DESC')->
        paginate(10);
    }

    /**
     * getting 10 more posts
     *
     * @param integer|NULL $id
     * @param integer|NULL $userId
     * @return void
     */
    public static function loadMorePosts($id, $userId){
        if(is_null($userId))
            $posts = Post::where('status', 'available')->where('id', '>',$id)->orderBy('created_at')->take(10)->get();
        else $posts = Post::where('status', 'available')->where('id', '>', $id)->where('user_id', $userId)->orderBy('created_at')->take(10)->get();
        
        $commentNumber = [];
        $tagNames = [];
        $users = [];
        $imageLocation = [];
        foreach ($posts as $key => $post) {
            $commentNumber[$key] = $post->comments->count();
            $tagNames[$key] = $post->tag->name;
            $users[$key] = $post->user->name;
            $imageLocation[$key] = $post->postImages[0]->location;
        }
        return response()->json([
                "posts" => $posts,
                "commentNumber" => $commentNumber,
                "tagNames" => $tagNames,
                'users' => $users,
                'imageLocation' => $imageLocation
            ]);
    }
    
    /**
     * 
     *
     * @param string $availableOrArchived
     * @param integer $sortOption
     * @param integer $userId
     * @return void
     */
    public static function sortPosts(string $availableOrArchived, int $sortOption, int $userId){
        // Available Posts = $availableOrArchived = available
        // Archived Posts = $availableOrArchived = archive
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
                return self::sortComments($userId, ($availableOrArchived === 'available') ? 'available' : 'archive');
                break;
        }
    }

    /**
     * 
     *
     * @param integer $userId
     * @param string $status
     * @return void
     */
    private static function sortComments(int $userId, string $status){
        return Post::where(['user_id' => $userId, 'status' => $status])
                    ->withCount(['comments'])
                    ->orderBy('comments_count', 'DESC')
                    ->paginate(10);
    }

    /**
     * 
     *
     * @param string $keyword
     * @return void
     */
    public static function getPostdataExchangeRequest(string $keyword){
        $upperCase = strtoupper($keyword);
        $lowerCase = strtolower($keyword);
        return Post::select('header', 'id')->where([
            "user_id" => Auth()->user()->id,
            "status" => 'available'
        ])->where('header', 'like', "%{$upperCase}%")
          ->orWhere('header', 'like', "%{$lowerCase}%")
          ->first() ?: [];
    }

    /**
     * 
     *
     * @param integer $id
     * @param string $status
     * @return void
     */
    public static function checkPostStatus(int $id, string $status){
        return (Post::where([
            'id' => $id,
            "status" => $status
        ])->first()) ? true : false;
    }


    /**
     * 
     *
     * @param array $postsIds
     * @return void
     */
    public static function moveToArchive(array $postsIds){
        foreach($postsIds as $rowId){
            $x = Post::find($rowId);
            $x->status = 'archive';
            $x->save();
        }
        // Post::destroy($postsIds);
    }
}


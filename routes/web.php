<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// loads the landaing page
Route::get('/', 'HomeController@welcome')->name('wlcome');

Auth::routes();

// loads the homr page after the user logged in
Route::get('/home', 'HomeController@index')->name('home');

// loads posts VIA AJAX
Route::post('/home/loadMorePosts', 'HomeController@loadMorePosts')->name('loadMorePosts');

// show a single post for visitor & user
Route::get('/show/post/{post}', 'PostController@show')->name('showPost');

// display the posts for a visitor
Route::get("/posts", "PostController@showWithNoAuth")->name('showPostsNoAuth');

// loads more posts for a visitor // TODO :: might make them in the same function 'controller function'
Route::post("/show/all/postsNoAuth", "PostController@loadMorePostsNoAuth")->name('loadshowPostsNoAuth');

// adds a post to the wish list
Route::post("/addToWishList/{post}", "WishController@addPostToWishList")->name('addPostToWishList');

// deleting a wish
// TODO make it delete HTTP request
Route::post("/deleteWishedPost/{post}", "WishController@deleteWish")->name('deleteWish');

// show the wished posts
Route::post("/wishedPosts", "WishController@showWishedPosts")->name('showWishedPosts');

// adding a comment
Route::post("/post/{post}/addComment", "CommentController@addComment")->name('addComment');

// displaying ta user profile
Route::get("/{user}", "UserController@profile")->name('profile');
// ??
// Route::post("/new/{user}/followers", "UserController@newFollowerRequestedName")->name('newFollowerRequestedName');

// checking for a new follow requests
// opens a modal 
Route::post("/show/follow-Requests", "UserController@showFollowingRequests")->name('showFollowingRequests');

// approve the follow request
Route::patch("/approve/follow", "UserController@approveFollow")->name('approveFollow');

// decline the follow request http request
Route::delete("/decline/follow", "UserController@declineFollow")->name('declineFollow');

// getting all the followers
Route::post("/user/followers", "UserController@seeFollowers")->name('seeFollowers');

// // unFollow the user from the profile page
// Route::post("/unFollow", "UserController@unFollow")->name('unfollow');

// // Follow the user from profile page
// Route::post("/Follow", "UserController@follow")->name('follow');

// cancel the follow from the profile page
Route::delete("/cancelFollow", "UserController@cancelFollow")->name('cencelFollowRequest');

// Follow the user from profile page
Route::post("/followUser" , "UserController@followUser")->name('followUser');

// unFollow the user from the profile page
Route::delete("/unfollowUser", "UserController@unfollowUser")->name('unfollowUser');


// get a user's posts from sortShowUserPosts page 
Route::get('/posts/{user}', "PostController@DescendingNAvailable")->name('allUserPosts'); // old name is allUserPosts

// get all the user followers
Route::post('/user/following', "UserController@seeTheUsersYouAreFollowing")->name('seeTheUsersYouAreFollowing');


// 6 routes for sorting the data with pagination from sortShowUserPosts page
// this in not good 
// DRY
Route::prefix('/posts/{user}')->group(function(){
        Route::get('/DescendingNAvailable', "PostController@DescendingNAvailable")->name('DescendingNAvailable');
        Route::get('/AscendingNAvailable', "PostController@AscendingNAvailable")->name('AscendingNAvailable');
        Route::get('/DescendingNArchived', "PostController@DescendingNArchived")->name('DescendingNArchived');
        Route::get('/AscendingNArchived', "PostController@AscendingNArchived")->name('AscendingNArchived');
        Route::get('/commentsNAvailable', "PostController@commentsNAvailable")->name('commentsNAvailable');
        Route::get('/commentsNArchived', "PostController@commentsNArchived")->name('commentsNArchived');
});

Route::post('/show/user/posts/profile', 'PostController@loadUserPosts')->name('loadUserPosts');

Route::get('/chat', "UserController@chat")->name('openChat');

Route::get('/json/{json}','HomeController@particles');
Route::get('/search/posts/{keyword}', 'PostController@getPostdataExchangeRequest')->where('keyword', '[A-Za-z]+');
Route::post('/sendExchangeRequest', 'UserController@sendExchangeRequest');

Route::post('/exchangeRequest/loadMore', 'UserController@exchangeRequestLoadMore')->name('exchangeRequestLoadMore');





Route::prefix('/show/exchangeRequests')->group(function(){
        Route::get('/', 'UserController@seeExchangeRequest')->name('exchangeRequest');        
        Route::middleware(['onlyAjax'])->group(function () {
                Route::get('/DESC', 'UserController@seeExchangeRequestDESC');
                Route::get('/ASC', 'UserController@seeExchangeRequestASC');
        });
        Route::patch('/accept', 'UserController@acceptExchangeRequest');
        Route::delete('/delete', 'UserController@deleteExchangeRequest');
});



Route::get("/explore/tags/{keyword?}", 'UserController@exploreTageReturnView')->name('exploreTage');




Route::get('/testing/now', function(){
// dd(
        
//         // Mercury\ExchangeRequest::where([
//         //         'user_id' => Auth()->user()->id
//         // ])->with(['exchangeRequests'])->get()
//         Mercury\Post::where([
//                 'user_id' => Auth()->user()->id
//         ])->withCount(['exchangeRequests'])->get()
//         ,
//         Mercury\Post::find(586)->exchangeRequests()->where('user_id', Auth()->user()->id)->get()
//         ,
//         Mercury\ExchangeRequest::with(['post' => function($q){
//                 $q->where([
//                     "user_id" => Auth()->user()->id
//                 ]);
//             }])->get()
// );
        // dd(
        //         Mercury\ExchangeRequest::whereHas('post', function($q){
        //                 $q->where('user_id',  22);
        //         })->count(),
        //         Mercury\Post::whereHas('exchangeRequests', function($q){
        //                 $q->where('user_id',  Auth()->user()->id);
        //         })->get(),
        //         Mercury\Post::has('exchangeRequests')->get(),
        //         Mercury\ExchangeRequest::has('post')->get()
        // );
        return Mercury\ExchangeRequest::dataForTheExchangeRequstsView();
});


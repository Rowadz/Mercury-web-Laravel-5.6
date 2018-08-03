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
Route::get('/', 'HomeController@welcome');

Auth::routes();

// loads the homr page after the user logged in
Route::get('/home', 'HomeController@index')->name('home');

// loads posts VIA AJAX
Route::post('/home/loadMorePosts', 'HomeController@loadMorePosts')->name('loadMorePosts');

// show a single post for visitor & user
Route::get('/show/post/{post}', 'PostController@show')->name('showPost');

// display the posts for a visitor
Route::get("/show/all/posts", "postController@showWithNoAuth")->name('showPostsNoAuth');

// loads more posts for a visitor // TODO :: might make them in the same function 'controller function'
Route::post("/show/all/postsNoAuth", "postController@loadMorePostsNoAuth")->name('loadshowPostsNoAuth');

// adds a post to the wish list
Route::post("/post/add-to-wish-list/{post}", "WishController@addPostToWishList")->name('addPostToWishList');

// show the wished posts
Route::get("/user/show-wished-posts", "WishController@showAllPosts")->name('showWishedPosts');

// deleting a wish
Route::post("/user/delete-wished-post/{post}", "WishController@deleteWish")->name('deleteWish');

// adding a comment
Route::post("/post/{post}/addComment", "CommentController@addComment")->name('addComment');

// displaying ta user profile
Route::get("/{user}", "UserController@profile")->name('profile');
// ??
Route::post("/new/{user}/followers", "UserController@newFollowerRequestedName")->name('newFollowerRequestedName');

// checking for a new follow requests
// opens a modal 
Route::post("/show/follow-Requests", "UserController@showFollowingRequests")->name('showFollowingRequests');

// approve the follow request
Route::post("/approve/follow", "UserController@approveFollow")->name('approveFollow');

// decline the follow request
Route::post("/decline/follow", "UserController@declineFollow")->name('declineFollow');

// getting all the followers
Route::get("/followers", "UserController@seeFollowers")->name('seeFollowers');

// unFollow the user from the profile page
Route::post("/unFollow", "UserController@unFollow")->name('unfollow');

// Follow the user from profile page
Route::post("/Follow", "UserController@follow")->name('follow');

// cancel the follow from the profile page
Route::post("/cancelFollow", "UserController@cancelFollow")->name('cencelFollowRequest');

// Follow the user from profile page
Route::post("/followUser" , "UserController@followUser")->name('followUser');

// unFollow the user from the profile page
Route::post("/unfollowUser", "UserController@unfollowUser")->name('unfollowUser');


// get a user's posts from sortShowUserPosts page 
Route::get('/posts/{user}', "PostController@DescendingNAvailable")->name('allUserPosts'); // old name is allUserPosts

// get all the user followers
Route::get('/following', "UserController@seeTheUsersYouAreFollowing")->name('seeTheUsersYouAreFollowing');


// 6 routes for sorting the data with pagination from sortShowUserPosts page
// this in not good 
// DRY
Route::get('/posts/{user}/DescendingNAvailable/', "PostController@DescendingNAvailable")->name('DescendingNAvailable');
Route::get('/posts/{user}/AscendingNAvailable/', "PostController@AscendingNAvailable")->name('AscendingNAvailable');
Route::get('/posts/{user}/DescendingNArchived/', "PostController@DescendingNArchived")->name('DescendingNArchived');
Route::get('/posts/{user}/AscendingNArchived/', "PostController@AscendingNArchived")->name('AscendingNArchived');
Route::get('/posts/{user}/commentsNAvailable/', "PostController@commentsNAvailable")->name('commentsNAvailable');
Route::get('/posts/{user}/commentsNArchived/', "PostController@commentsNArchived")->name('commentsNArchived');
Route::post('/show/user/posts/profile', 'PostController@loadUserPosts')->name('loadUserPosts');

Route::get('/chat', "UserCompoenet@chat")->name('openChat');

Route::bind('user', function ($value) {
        return Mercury\User::where('name', $value)->first() ?? abort(404);
});


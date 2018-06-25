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

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home/loadMorePosts', 'HomeController@loadMorePosts');

Route::get('/show/post/{post}', 'PostController@show');

Route::get("/show/all/posts", "postController@showWithNoAuth");

Route::post("/show/all/postsNoAuth", "postController@loadMorePostsNoAuth");

Route::post("/post/add-to-wish-list/{post}", "WishController@addPostToWishList");

Route::get("/user/show-wished-posts", "WishController@showAllPosts");

Route::post("/user/delete-wished-post/{post}", "WishController@deleteWish");

Route::post("/post/{post}/addComment", "CommentController@addComment");

Route::get("/@/{user}", "UserController@profile")->name('profile');

Route::post("/new/{user}/followers", "UserController@newFollowerRequestedName");

Route::get("/show/follow-Requests", "UserController@showFollowingRequests");

Route::post("/approve/follow", "UserController@approveFollow");
Route::post("/decline/follow", "UserController@declineFollow");

Route::get("/followers", "UserController@seeFollowers");

Route::post("/unFollow", "UserController@unFollow");
Route::post("/Follow", "UserController@follow");
Route::post("/cancelFollow", "UserController@cancelFollow")->name('cencelFollowRequest');

Route::bind('user', function ($value) {
        return Mercury\User::where('name', $value)->first() ?? abort(404);
});


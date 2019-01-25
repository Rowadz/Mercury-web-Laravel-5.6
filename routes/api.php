<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get("/test/posts", function(){
//     return response()->json(["posts" => Mercury\Post::take(10)->get()]);
// });

Route::post('/login', 'API\AuthAPI@login');
Route::post('/register', 'API\AuthAPI@register');

Route::get('/posts', 'API\PostController@paginate');
Route::get('/post/{id}', 'API\PostController@get');

Route::get('/bookmarked/{postId}/{userId}', 'API\PostController@isWished');
Route::post('/bookmark', 'API\PostController@bookmark');
Route::post('/deleteBookmark', 'API\PostController@deleteBookmark');

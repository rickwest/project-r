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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    // Dashboard
    Route::get('/dashboard', 'DashboardController')->name('dashboard');

    // Search
    Route::get('/search', 'SearchController');

    // Post
    Route::get('/posts', 'PostController@index');
    Route::get('post/new', 'PostController@create')->name('post.create');
    Route::get('/post/{post}', 'PostController@show')->name('post.show');
    Route::post('/post', 'PostController@store')->name('post.store');
    Route::delete('/post/{post}', 'PostController@destroy');

    // Post Comment
    Route::get('/post/{post}/comments', 'PostCommentController@index');
    Route::post('/post/{post}/comment', 'PostCommentController@store');

    // Post Like
    Route::put('/post/{post}/like', 'PostLikeController');

    // Media
    Route::post('/media', 'MediaController@store');
    Route::delete('/media', 'MediaController@destroy');

    // User - Route must be last to ensure attempt to match all other routes first
    Route::get('/{user}', 'UserController')->name('user');
});

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
    Route::get('dashboard', 'DashboardController')->name('dashboard');

    // Post
    Route::get('/posts', 'PostController@index');
    Route::get('post/new', 'PostController@create')->name('post.create');
    Route::get('/post/{post}', 'PostController@show')->name('post.show');
    Route::post('/post/{post}', 'PostController@store')->name('post.store');
    Route::post('post/image', 'PostController@storeImage');
});

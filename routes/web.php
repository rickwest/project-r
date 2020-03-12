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
    // Dashboard
    Route::get('dashboard', 'DashboardController')->name('dashboard');

    // Posts
    Route::resource('posts', 'PostController', ['except' => [
//    'index', 'show', 'new,'
    ]]);
    Route::post('posts/image', 'PostController@storeImage');
});

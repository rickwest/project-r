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

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', 'PostController@index');
//Route::get('/{posts}', 'PostController@show');
Route::get('/posts/new', 'PostController@create')->name('posts.create');
Route::post('posts', 'PostController@store')->name('posts.store');
Route::post('posts/images', 'PostController@images');
//Route::patch('/{posts}', 'PostController@update');
//Route::delete('/{posts}', 'PostController@destroy');

<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Posts
Broadcast::channel('posts', function ($user) {
    return Auth::check();
});

// Post Comment
Broadcast::channel('post.{post_id}.comment', function ($user) {
    return Auth::check();
});

// Post Like
Broadcast::channel('post.{post_id}.like', function ($user) {
    return Auth::check();
});

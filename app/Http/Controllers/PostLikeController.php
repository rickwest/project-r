<?php

namespace App\Http\Controllers;

use App\Events\PostLiked;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Toggle a like on a post.
     *
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $request, Post $post)
    {
        $post->toggleLike();

        event(new PostLiked($post));

        return response()->json($post);
    }
}

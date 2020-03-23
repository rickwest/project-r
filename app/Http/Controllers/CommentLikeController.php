<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentLiked;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    /**
     * Toggle a like on a comment.
     *
     * @param Request $request
     * @param Comment $comment
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $request, Comment $comment)
    {
        $comment->toggleLike();

        event(new CommentLiked($comment));

        return response()->json($comment);
    }
}

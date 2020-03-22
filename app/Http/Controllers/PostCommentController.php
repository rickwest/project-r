<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentPosted;
use App\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostCommentController extends Controller
{
    /**
     * Return a list of post comments.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function index(Post $post)
    {
        $comments = $post->comments()->with(['user', 'user.profile'])->get();

        return response()->json($comments);
    }

    /**
     * Store a newly created comment in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     */
    public function store(Request $request, Post $post)
    {
        $this->validator($request->all())->validate();

        $comment = $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);

        event(new CommentPosted($comment));

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    /**
     * Get a validator for an incoming comment store request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'body' => 'required|string',
        ]);
    }
}

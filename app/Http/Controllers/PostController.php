<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Post::paginate(10));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $post = Post::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'images' => $request['images'],
            'user_id' => $request->user()->id,
        ]);

        $request->session()->flash('success', 'Posted! You\'re now viewing the live post.');

        return response()->json($post);
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * Get a validator for an incoming posts store or update request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'body' => 'required',
            'title' => 'sometimes|max:255',
            'images' => 'sometimes|array',
        ]);
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function storeImage(Request $request) {
        $request->validate([
            'file' => 'required|file|image'
        ]);

        $path = $request->file('file')->store('posts');

        return $path;
    }
}

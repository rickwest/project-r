<?php

namespace App\Http\Controllers;

use App\Events\PostPosted;
use App\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Return a paginated collection of posts.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $posts = Post::query();

        if ($request->has('user_id')) {
            $posts->where('user_id', $request->get('user_id'));
        }

        return response()->json($posts->paginate(10));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View
     */
    public function create()
    {
        return view('post.create');
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

        $post = $request->user()->posts()->create($request->all());

        if ($request->media) {
            collect($request->media)->map(function ($media) use ($post) {
                $post->addMediaFromDisk($media)->toMediaCollection('images');
            });
        }

        $request->session()->flash('success', "Posted! You're now viewing the live post.");

        event(new PostPosted($post));

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
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Remove the specified post from storage.
     *
     * @param Post $post
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([], 204);
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
            'body' => 'required|string',
            'title' => 'nullable|string|max:255',
            'media' => 'nullable|array',
        ]);
    }
}

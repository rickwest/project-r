<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return View
     */
    public function __invoke()
    {
        $popularPosts = Post::withCount('likes')
            ->with('likes.user')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        $recentRegistrations = User::latest()->take(5)->get();

        return view('dashboard', [
            'suggestions' => $recentRegistrations,
            'trending' => $popularPosts,
        ]);
    }
}

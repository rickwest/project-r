<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show a 'profile' page for an individual user.
     *
     * @param User $user
     * @return View
     */
    public function __invoke(User $user)
    {
        return view('user', [
            'user' => $user
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {

        return User::search($request->get('q', ''))->get()
            ->load('profile');
    }
}

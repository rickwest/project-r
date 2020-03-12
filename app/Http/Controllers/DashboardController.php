<?php

namespace App\Http\Controllers;

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
        return view('dashboard');
    }
}

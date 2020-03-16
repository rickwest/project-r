<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile of the authenticated user.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'profile' => $request->user()->profile,
        ]);
    }

    /**
     * Update the profile of the authenticated user in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->user()->profile()->update($request->only([
            'first_name', 'last_name', 'bio', 'location', 'occupation'
        ]));


        if ($request->avatar) {
            $request->user()->profile->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        $request->session()->flash('success', 'Profile updated successfully!');

        return back();
    }

    /**
     * Get a validator for an incoming profile update request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'nullable|string|max:32',
            'last_name' => 'nullable|string|max:32',
            'bio' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:128',
            'occupation' => 'nullable|string|max:128',
            'avatar' => 'nullable|image|max:2048',
        ]);
    }
}

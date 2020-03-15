<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateUserProfile
{
    /**
     * Handle the event.
     *
     * Create a profile for a user on registration.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->profile()->create();
    }
}

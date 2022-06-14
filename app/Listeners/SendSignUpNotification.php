<?php

namespace App\Listeners;

use App\Events\UserSignedUp;
use App\Notifications\SignUpNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSignUpNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserSignedUp  $event
     * @return void
     */
    public function handle(UserSignedUp $event)
    {
        $user = $event->user;

        $user->notify(new SignUpNotification($user));
    }
}

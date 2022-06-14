<?php

namespace App\Listeners;

use App\Events\UserUpdated;
use App\Notifications\UserUpdateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserUpdateNotification
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
     * @param  \App\Events\UserUpdated  $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        $user = $event->user;

        $user->notify(new UserUpdateNotification($user));
    }
}

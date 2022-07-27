<?php

namespace App\Listeners;

use App\Events\UserMailToAdmin;
use App\Models\User;
use App\Notifications\UserMailToAdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserMailToAdminNotification
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
     * @param  \App\Events\UserMailToAdmin $event
     * @return void
     */
    public function handle(UserMailToAdmin $event)
    {
        $user = $event->user;
        $admins = User::where('role', 'admin')->get();
        $message = $event->message;

        foreach($admins as $admin) {
            $admin->notify(new UserMailToAdminNotification($user, $message));
        }
    }
}

<?php

namespace App\Listeners;

use App\Events\TeacherVerified;
use App\Notifications\VerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationNotification
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
     * @param  \App\Events\TeacherVerified  $event
     * @return void
     */
    public function handle(TeacherVerified $event)
    {
        $teacher = $event->user;

        $teacher->notify(new VerificationNotification($teacher));
    }
}

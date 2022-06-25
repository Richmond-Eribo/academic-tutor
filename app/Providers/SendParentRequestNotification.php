<?php

namespace App\Providers;

use App\Providers\TeacherRequestedFor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendParentRequestNotification
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
     * @param  \App\Providers\TeacherRequestedFor  $event
     * @return void
     */
    public function handle(TeacherRequestedFor $event)
    {
        //
    }
}

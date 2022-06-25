<?php

namespace App\Listeners;

use App\Events\TeacherRequestedFor;
use App\Models\User;
use App\Notifications\ParentRequestNotification;
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
     * @param  object  $event
     * @return void
     */
    public function handle(TeacherRequestedFor $event)
    {
        $admins = User::where('role', 'admin')->get();
        $parent = $event->parent;
        $teacher = $event->teacher;

        foreach($admins as $admin) {
            $admin->notify(new ParentRequestNotification($parent, $teacher));
        }
    }
}

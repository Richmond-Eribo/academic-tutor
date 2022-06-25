<?php

namespace App\Listeners;

use App\Events\TeacherRequestedForCancelled;
use App\Models\User;
use App\Notifications\CancelParentRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCancelParentRequestNotification
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
    public function handle(TeacherRequestedForCancelled $event)
    {
        $admins = User::where('role', 'admin')->get();
        $parent = $event->parent;
        $teacher = $event->teacher;

        foreach($admins as $admin) {
            $admin->notify(new CancelParentRequestNotification($parent, $teacher));
        }
    }
}

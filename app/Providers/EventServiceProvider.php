<?php

namespace App\Providers;

use App\Events\TeacherRequestedFor;
use App\Events\TeacherRequestedForCancelled;
use App\Events\TeacherVerified;
use App\Events\UserMailToAdmin;
use App\Events\UserSignedUp;
use App\Events\UserUpdated;
use App\Listeners\SendCancelParentRequestNotification;
use App\Listeners\SendParentRequestNotification;
use App\Listeners\SendSignUpNotification;
use App\Listeners\SendUserMailToAdminNotification;
use App\Listeners\SendUserUpdateNotification;
use App\Listeners\SendVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserSignedUp::class => [
            SendSignUpNotification::class,
        ],
        UserUpdated::class => [
            SendUserUpdateNotification::class,
        ],
        TeacherVerified::class => [
            SendVerificationNotification::class,
        ],
        TeacherRequestedFor::class => [
            SendParentRequestNotification::class,
        ],
        TeacherRequestedForCancelled::class => [
            SendCancelParentRequestNotification::class,
        ],
        UserMailToAdmin::class => [
            SendUserMailToAdminNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}

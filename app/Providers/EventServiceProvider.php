<?php

namespace App\Providers;

use App\Events\PostCommented;
use App\Events\PostViewed;
use App\Events\PostVoted;
use App\Listeners\AddPostViewEntry;
use App\Listeners\UpdatePostVotes;
use App\Listeners\UserNotificationManager;
use App\Models\PostVote;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        PostViewed::class => [
            AddPostViewEntry::class
        ],
        PostVoted::class => [
            UpdatePostVotes::class,
            UserNotificationManager::class
        ],
        PostCommented::class => [
            UserNotificationManager::class
        ]
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

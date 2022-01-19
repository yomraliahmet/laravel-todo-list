<?php

namespace App\Providers;

use App\Events\TodoCompleted;
use App\Events\TodoCreated;
use App\Events\TodoDeleted;
use App\Events\TodoUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TodoCreated::class => [
            \App\Listeners\TodoCreated::class,
        ],
        TodoUpdated::class => [
            \App\Listeners\TodoUpdated::class,
        ],
        TodoDeleted::class => [
            \App\Listeners\TodoDeleted::class,
        ],
        TodoCompleted::class => [
            \App\Listeners\TodoCompleted::class,
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
}

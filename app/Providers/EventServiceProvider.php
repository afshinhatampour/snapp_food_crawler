<?php

namespace App\Providers;

use App\Events\CrawlCitiesEvent;
use App\Events\CrawlRestaurantsEvent;
use App\Events\GetCommentsEvent;
use App\Listeners\CrawlCitiesListener;
use App\Listeners\CrawlRestaurantsListener;
use App\Listeners\GetCommentsListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CrawlCitiesEvent::class => [
            CrawlCitiesListener::class
        ],
        CrawlRestaurantsEvent::class => [
            CrawlRestaurantsListener::class
        ],
        GetCommentsEvent::class => [
            GetCommentsListener::class
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
}

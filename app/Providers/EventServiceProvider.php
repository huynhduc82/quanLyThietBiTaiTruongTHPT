<?php

namespace App\Providers;

use App\Events\ReservationEvent;
use App\Listeners\Reservation\MailReservationSuccessToManageListener;
use App\Listeners\Reservation\MailReservationSuccessToUserListener;
use App\Listeners\Reservation\NotificationReservationSuccessToManageListener;
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
        ReservationEvent::class => [
//            NotificationReservationSuccessToManageListener::class,
//            MailReservationSuccessToManageListener::class,
            MailReservationSuccessToUserListener::class,
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

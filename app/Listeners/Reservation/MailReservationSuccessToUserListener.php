<?php

namespace App\Listeners\Reservation;

use App\Mails\Reservation\ReservationSuccessMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailReservationSuccessToUserListener extends Mailable
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     */
    public function handle($event)
    {
        $model = $event->getModel();

        return Mail::queue(new ReservationSuccessMail($model));
    }
}

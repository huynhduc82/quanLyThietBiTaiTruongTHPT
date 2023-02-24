<?php

namespace App\Listeners\Reservation;

use Exception;
use Illuminate\Mail\Mailable;

class MailReservationSuccessToManageListener extends Mailable
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
     * @return $this
     */
    public function handle($event)
    {
        $model = $event->getModel();
        dd($model->user->email);
        try {
            return $this->to($model->user->email)->subject('111111');
        } catch (Exception $exception)
        {
            dd($exception);
        }
    }
}

<?php

namespace App\Mails\Reservation;

use App\Models\EquipmentReservations\EquipmentReservation;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class ReservationSuccessMail extends Mailable implements ShouldQueue
{
    use Queueable;

    protected EquipmentReservation $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function build()
    {
        try {
            return $this
                ->to($this->model->user->email)
                ->subject(__('message.title.reservation'))
                ->markdown('emails.reservation.reservation_success')
                ->with([
                    'name' => $this->model->user->name,
                    'model' => $this->model,
                ]);
        } catch (Exception $exception) {
            dd($exception);
        }
    }
}

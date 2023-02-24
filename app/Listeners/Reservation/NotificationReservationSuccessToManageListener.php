<?php

namespace App\Listeners\Reservation;

use App\Models\EquipmentReservations\EquipmentReservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationReservationSuccessToManageListener implements ShouldQueue
{
    public EquipmentReservation $reservation;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EquipmentReservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $model = $event->getModel();
        dd($model);
    }
}

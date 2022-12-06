<?php

namespace App\Repositories\Eloquents\Reservations;

use App\Models\EquipmentReservations\EquipmentReservationDetails;
use App\Repositories\BaseEloquentRepository;

class EquipmentReservationDetailRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return EquipmentReservationDetails::class;
    }

    public function store($input)
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }
}

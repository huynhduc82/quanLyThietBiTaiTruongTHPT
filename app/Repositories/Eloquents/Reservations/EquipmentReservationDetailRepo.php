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

    public function edit($id, $input = [], $eid = 0)
    {
        $query = $this->model->newQuery();

        return $query->where('type_of_equipment_id', $id)->where('equipment_reservation_id', $eid)->update($input);
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->delete();
    }
}

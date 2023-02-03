<?php

namespace App\Repositories\Eloquents\Maintenance;

use App\Models\EquipmentReservations\EquipmentReservationDetails;
use App\Models\Maintenance\MaintenanceDetails;
use App\Repositories\BaseEloquentRepository;

class MaintenanceDetailsRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return MaintenanceDetails::class;
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

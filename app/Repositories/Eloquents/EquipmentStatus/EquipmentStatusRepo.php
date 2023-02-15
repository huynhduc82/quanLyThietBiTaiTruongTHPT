<?php

namespace App\Repositories\Eloquents\EquipmentStatus;

use App\Models\EquipmentStatus\EquipmentStatus;
use App\Repositories\BaseEloquentRepository;

class EquipmentStatusRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return EquipmentStatus::class;
    }

    public function store($input = null)
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function updateStatusDetails($input, $id, $status): int
    {
        $query = $this->model->newQuery();
        $param = ['condition_details' => $input];
        if ($status != EquipmentStatus::STATUS_OK)
        {
            $param = array_merge($param,['can_continue_to_use' => false]);
        }
        $param['status'] = EquipmentStatus::STATUS_BROKEN;
        return $query->where('id', $id)->update($param);
    }
}

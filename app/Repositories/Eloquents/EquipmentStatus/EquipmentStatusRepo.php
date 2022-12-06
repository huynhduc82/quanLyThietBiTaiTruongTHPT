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
}

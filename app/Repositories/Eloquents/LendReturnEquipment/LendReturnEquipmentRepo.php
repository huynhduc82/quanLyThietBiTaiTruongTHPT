<?php

namespace App\Repositories\Eloquents\LendReturnEquipment;

use App\Models\LendReturnEquipments\LendReturnEquipment;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentRepo;

class LendReturnEquipmentRepo extends BaseEloquentRepository implements ILendReturnEquipmentRepo
{
    public function model()
    {
        // TODO: Implement model() method.
        return LendReturnEquipment::class;
    }

    public function store($input = [])
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function return($input = [], $id = 0)
    {
        $query = $this->model->newQuery();

        $query->where('id', $id)->update($input);
    }
}

<?php

namespace App\Repositories\Eloquents\LendReturnEquipment;

use App\Models\LendReturnEquipments\LendReturnEquipmentDetails;
use App\Repositories\BaseEloquentRepository;
use App\Repositories\Contracts\LendReturnEquipment\ILendReturnEquipmentDetailsRepo;

class LendReturnEquipmentDetailsRepo extends BaseEloquentRepository implements ILendReturnEquipmentDetailsRepo
{
    public function model()
    {
        // TODO: Implement model() method.
        return LendReturnEquipmentDetails::class;
    }

    public function store($input = [])
    {
        $query = $this->model->newQuery();

        $query->create($input);
    }
}

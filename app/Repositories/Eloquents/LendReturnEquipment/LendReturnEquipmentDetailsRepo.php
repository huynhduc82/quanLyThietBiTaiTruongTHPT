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

        return $query->create($input);
    }

    public function destroy($lrId, $typeId)
    {
        $query = $this->model->newQuery();

        return $query->where('lend_return_equipment_id', $lrId)
            ->where('type_of_equipment_id', $typeId)->delete();
    }

    public function edit($id, $input, $typeId)
    {
        $query = $this->model->newQuery();

        return $query->where('lend_return_equipment_id', $id)->where('type_of_equipment_id', $typeId)->update($input);
    }
}

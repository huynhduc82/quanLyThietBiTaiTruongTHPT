<?php

namespace App\Repositories\Eloquents\Liquidation;

use App\Models\EquipmentLiquidations\EquipmentLiquidationDetails;
use App\Repositories\BaseEloquentRepository;

class LiquidationDetailsRepo extends BaseEloquentRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return EquipmentLiquidationDetails::class;
    }

    public function store($input)
    {
        $query = $this->model->newQuery();

        return $query->create($input);
    }

    public function edit($id, $input = [], $eid = 0)
    {
        $query = $this->model->newQuery();

        return $query->where('type_of_equipment_id', $id)->where('equipment_liquidation_id', $eid)->update($input);
    }

    public function delete($id)
    {
        $query = $this->model->newQuery();

        return $query->where('id', $id)->delete();
    }
}

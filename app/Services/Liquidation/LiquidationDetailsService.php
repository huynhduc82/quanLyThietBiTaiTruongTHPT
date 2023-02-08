<?php

namespace App\Services\Liquidation;

use App\Helpers;
use App\Repositories\Contracts\Liquidation\ILiquidationDetailsRepo;
use App\Repositories\Contracts\Maintenance\IMaintenanceDetailsRepo;
use App\Repositories\Contracts\Reservations\IEquipmentReservationDetailRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;

class LiquidationDetailsService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return ILiquidationDetailsRepo::class;
    }

    public function store($input = [])
    {
        foreach ($input['equipment'] as $item)
        {
            $liquidationDetails = [];
            $liquidationDetails['equipment_liquidation_id'] = $input['liquidation_id'];
            $liquidationDetails['equipment_id'] =  $item['id'];
            $liquidationDetails['room_id'] =  $input['room_id'];
            $liquidationDetails['liquidation_reason'] =  $item['liquidation_reason'];
            $liquidationDetails['liquidation_method'] =  $item['liquidation_method'];

            $this->repository->store($liquidationDetails);
        }
    }

    public function edit($input = [], $id = 0, $model = null)
    {
        foreach ($input['equipment'] as $item)
        {
            $details = $model->details->where('type_of_equipment_id', $item['type_of_equipment_id'])->first();
            $diffOld = array_diff(explode(Helpers::SEPARATOR, $details->equipment_details), $item['equipment_details']);

            $liquidationDetails = [];
            $liquidationDetails['equipment_reservation_id'] = $id;
            $liquidationDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];
            $liquidationDetails['quantity'] = count($item['equipment_details']);
            $liquidationDetails['equipment_details'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
            $this->repository->edit($item['type_of_equipment_id'], $liquidationDetails, $id);
            $details->equipments()->sync(array_values($item['equipment_details']));

            if (!empty($diffOld)) {
                app(EquipmentService::class)->updateRentQuantityOld($item['type_of_equipment_id'], $diffOld,false);
            }
        }
        app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);
    }

    public function delete($model = null)
    {
        $details = $model->details;
        foreach ($details as $item)
        {
            $item->equipments()->detach();
            $this->repository->delete($item->id);
        }

        app(EquipmentService::class)->updateRentQuantity($details, false);
    }
}

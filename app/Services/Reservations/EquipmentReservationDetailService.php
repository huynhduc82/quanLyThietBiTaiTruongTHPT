<?php

namespace App\Services\Reservations;

use App\Helpers;
use App\Repositories\Contracts\Reservations\IEquipmentReservationDetailRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\Response\BaseService;

class EquipmentReservationDetailService extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IEquipmentReservationDetailRepo::class;
    }

    public function store($input = [])
    {
        foreach ($input['equipment'] as $item)
        {
            $reservationDetails = [];
            $reservationDetails['equipment_reservation_id'] = $input['equipment_reservation_id'];
            $reservationDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];
            $reservationDetails['quantity'] = count($item['equipment_details']);
            $reservationDetails['equipment_details'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
            $result = $this->repository->store($reservationDetails);
            $result->equipments()->attach(array_values($item['equipment_details']));
        }
    }

    public function edit($input = [], $id = 0, $model = null)
    {
        foreach ($input['equipment'] as $item)
        {
            $details = $model->details->where('type_of_equipment_id', $item['type_of_equipment_id'])->first();
            $diffOld = array_diff(explode(Helpers::SEPARATOR, $details->equipment_details), $item['equipment_details']);

            $reservationDetails = [];
            $reservationDetails['equipment_reservation_id'] = $id;
            $reservationDetails['type_of_equipment_id'] =  $item['type_of_equipment_id'];
            $reservationDetails['quantity'] = count($item['equipment_details']);
            $reservationDetails['equipment_details'] = implode(Helpers::SEPARATOR, $item['equipment_details']);
            $this->repository->edit($item['type_of_equipment_id'], $reservationDetails, $id);
            $details->equipments()->sync(array_values($item['equipment_details']));

            if (!empty($diffOld)) {
                app(EquipmentService::class)->updateRentQuantityOld($item['type_of_equipment_id'], $diffOld,false);
            }
        }
        app(EquipmentService::class)->updateRentQuantity($input['equipment'], true);
    }

    public function delete($model = null)
    {
        $param = [];
        $details = $model->details;
        foreach ($details as $item)
        {
            $item->equipments()->detach();
            $this->repository->delete($item->id);
            $param[] = explode(Helpers::SEPARATOR, $item->equipment_details);
        }

        app(EquipmentService::class)->updateRentQuantity($details, false);
    }
}

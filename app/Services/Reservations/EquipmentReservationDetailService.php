<?php

namespace App\Services\Reservations;

use App\Helpers;
use App\Repositories\Contracts\Reservations\IEquipmentReservationDetailRepo;
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
}

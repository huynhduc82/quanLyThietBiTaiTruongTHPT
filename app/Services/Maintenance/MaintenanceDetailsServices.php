<?php

namespace App\Services\Maintenance;

use App\Helpers;
use App\Models\Equipments\Equipment;
use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Repositories\Contracts\Maintenance\IMaintenanceDetailsRepo;
use App\Repositories\Contracts\Reservations\IEquipmentReservationDetailRepo;
use App\Services\Equipment\EquipmentService;
use App\Services\EquipmentStatus\EquipmentStatusServices;
use App\Services\Response\BaseService;

class MaintenanceDetailsServices extends BaseService
{
    public function repository(): string
    {
        // TODO: Implement repository() method.
        return IMaintenanceDetailsRepo::class;
    }

    public function store($input = [])
    {
        foreach ($input['equipment'] as $item)
        {
            $reservationDetails = [];
            $reservationDetails['maintenance_id'] = $input['maintenance_id'];
            $reservationDetails['equipment_id'] =  $item['id'];
            $equipment = Equipment::find($item['id']);
            $equipment->can_rent = false;
            $equipment->save();

            app(EquipmentService::class)->updateEquipmentStatus([$item['id']], false);
            $this->repository->store($reservationDetails);
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
        $details = $model->details;
        foreach ($details as $item)
        {
            $item->equipments()->detach();
            $this->repository->delete($item->id);
        }

        app(EquipmentService::class)->updateRentQuantity($details, false);
    }

    public function updateEquipmentStatus($id, $status)
    {
        $model = $this->repository->getModel()->newQuery()->where('maintenance_id', '=', $id)
            ->with('equipments')->first();
        foreach ($model->equipments as $equipment)
        {
            app(EquipmentStatusServices::class)->updateStatus($equipment->id, $status);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Equipments\Equipment;
use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Services\Equipment\TypeOfEquipmentService;
use App\Services\EquipmentStatus\EquipmentStatusServices;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquipmentImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $model = TypeOfEquipment::query()->updateOrCreate([
                "name" => $row['name'],
                "price" => $row['price'],
                "unit" => $row['unit'],
            ]);

            $param = ['condition_details' => EquipmentStatus::STATUS_ALL_GOOD,
                'can_continue_to_use' => EquipmentStatus::CAN_CONTINUE_USE];
            $equipmentStatusId = app(EquipmentStatusServices::class)->store($param);

            $quantity = Equipment::query()->where("type_of_equipment_id", '=', $model->id)->count();

            Equipment::query()->create([
                "equipment_status_id" => $equipmentStatusId,
                "type_of_equipment_id" => $model->id,
                "name" => $model->name . ' ' . $quantity + 1,
            ]);
        }
        app(TypeOfEquipmentService::class)->updateAllQuantity();
    }
}

<?php

namespace App\Transformers\Equipment;

use App\Models\Equipments\Equipment;
use App\Transformers\EquipmentStatus\EquipmentStatusTransformers;
use App\Transformers\Room\RoomTransformers;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class EquipmentTransformers extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'status',
        'room'
    ];

    public function transform(Equipment $model): array
    {
        return [
            'id' => $model->id,
//            'room_id' => $model->room_id ?? null,
//            'equipment_status_id' => $model->equipment_status_id ?? null,
            'type_of_equipment_id' => $model->type_of_equipment_id ?? null,
            'name' => $model->name,
            'can_rent' => $model->can_rent,
        ];
    }

    public function includeStatus(Equipment $model): Item|NullResource
    {
        $data = $model->relationLoaded('status') ? $model->status : null;

        return $data ? $this->item($data, new EquipmentStatusTransformers()) : $this->null();
    }

    public function includeRoom(Equipment $model): Item|NullResource
    {
        $data = $model->relationLoaded('room') ? $model->room : null;

        return $data ? $this->item($data, new RoomTransformers()) : $this->null();
    }
}

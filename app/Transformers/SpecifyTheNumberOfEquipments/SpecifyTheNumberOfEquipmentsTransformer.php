<?php

namespace App\Transformers\SpecifyTheNumberOfEquipments;

use App\Models\Equipments\Equipment;
use App\Models\SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipment;
use App\Transformers\EquipmentStatus\EquipmentStatusTransformers;
use App\Transformers\Room\RoomTransformers;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class SpecifyTheNumberOfEquipmentsTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(SpecifyTheNumberOfEquipment $model): array
    {
        return [
            'id' => $model->id,
            'equipment_id' => $model->equipment_id,
            'course_details_id' => $model->course_details_id,
            'quantity' => $model->quantity,
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

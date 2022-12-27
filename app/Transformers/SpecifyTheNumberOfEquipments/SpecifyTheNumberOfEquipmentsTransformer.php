<?php

namespace App\Transformers\SpecifyTheNumberOfEquipments;

use App\Models\SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipment;
use App\Transformers\Equipment\TypeOfEquipmentTransformers;
use App\Transformers\Room\RoomTransformers;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class SpecifyTheNumberOfEquipmentsTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'equipment'
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

    public function includeEquipment(SpecifyTheNumberOfEquipment $model): Item|NullResource
    {
        $data = $model->relationLoaded('equipment') ? $model->equipment : null;

        return $data ? $this->item($data, new TypeOfEquipmentTransformers()) : $this->null();
    }

    public function includeRoom(SpecifyTheNumberOfEquipment $model): Item|NullResource
    {
        $data = $model->relationLoaded('room') ? $model->room : null;

        return $data ? $this->item($data, new RoomTransformers()) : $this->null();
    }
}

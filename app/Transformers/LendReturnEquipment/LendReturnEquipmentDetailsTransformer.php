<?php

namespace App\Transformers\LendReturnEquipment;

use App\Models\LendReturnEquipments\LendReturnEquipmentDetails;
use App\Transformers\Equipment\EquipmentTransformers;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class LendReturnEquipmentDetailsTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'equipments'
    ];

    public function transform(LendReturnEquipmentDetails $model): array
    {
        return [
            'id' => $model->id,
            'equipment_reservation_id' => $model->equipment_reservation_id,
            'type_of_equipment_id' => $model->type_of_equipment_id,
            'quantity' => $model->quantity,
//            'equipment_id' => $model->equipment_id,
        ];
    }

    public function includeEquipments(LendReturnEquipmentDetails $model) :  Collection|NullResource
    {
        $data = $model->relationLoaded('equipments') ? $model->equipments : null;

        return ($data && $data->isNotEmpty()) ? $this->collection($data, new EquipmentTransformers())
            : $this->null();
    }
}

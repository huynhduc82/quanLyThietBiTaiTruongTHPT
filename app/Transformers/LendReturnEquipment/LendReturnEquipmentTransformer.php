<?php

namespace App\Transformers\LendReturnEquipment;

use App\Models\LendReturnEquipments\LendReturnEquipment;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class LendReturnEquipmentTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'details'
    ];

    public function transform(LendReturnEquipment $model): array
    {
        return [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'pick_up_time' => $model->pick_up_time,
            'returner_id' => $model->returner_id ?? null,
            'return_appointment_time' => $model->return_appointment_time,
            'return_time' => $model->return_time ?? null,
            'room_id' => $model->room_id ?? null,
        ];
    }

    public function includeDetails(LendReturnEquipment $model) :  Collection|NullResource
    {
        $data = $model->relationLoaded('details') ? $model->details : null;

        return ($data && $data->isNotEmpty()) ? $this->collection($data, new LendReturnEquipmentDetailsTransformer())
            : $this->null();
    }
}

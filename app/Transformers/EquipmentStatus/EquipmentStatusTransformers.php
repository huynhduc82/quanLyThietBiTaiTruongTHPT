<?php

namespace App\Transformers\EquipmentStatus;

use App\Models\EquipmentStatus\EquipmentStatus;
use League\Fractal\TransformerAbstract;

class EquipmentStatusTransformers extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(EquipmentStatus $model): array
    {
        return [
            'condition_details' => $model->condition_details,
            'can_continue_to_use' => $model->can_continue_to_use,
            'number_of_repairs' => $model->number_of_repairs,
        ];
    }
}

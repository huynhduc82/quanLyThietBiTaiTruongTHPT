<?php

namespace App\Transformers\Room;

use App\Models\Rooms\Room;
use League\Fractal\TransformerAbstract;

class RoomTransformers extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'status',
        'room'
    ];

    public function transform(Room $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'can_rent' => $model->can_rent,
        ];
    }
}

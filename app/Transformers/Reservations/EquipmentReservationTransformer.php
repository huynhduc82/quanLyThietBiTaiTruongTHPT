<?php

namespace App\Transformers\Reservations;

use App\Models\EquipmentReservations\EquipmentReservation;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class EquipmentReservationTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'details',
    ];

    public function transform(EquipmentReservation $model): array
    {
        return [
            'id' => $model->id,
            'user_id' => $model->user_id,
            'pick_up_time' => $model->pick_up_time,
            'return_appointment_time' => $model->return_appointment_time,
            'status' => $model->status,
        ];
    }

    public function includeDetails(EquipmentReservation $model) :  Collection|NullResource
    {
        $data = $model->relationLoaded('details') ? $model->details : null;

        return ($data && $data->isNotEmpty()) ? $this->collection($data, new EquipmentReservationDetailTransformer())
            : $this->null();
    }

//
//    public function includeRoom(Equipment $model): Item|NullResource
//    {
//        $data = $model->relationLoaded('room') ? $model->room : null;
//
//        return $data ? $this->item($data, new RoomTransformers()) : $this->null();
//    }
}

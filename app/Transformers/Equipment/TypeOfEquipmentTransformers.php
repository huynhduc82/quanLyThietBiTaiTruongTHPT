<?php

namespace App\Transformers\Equipment;

use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Transformers\ImageInfos\ImageInfoTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class TypeOfEquipmentTransformers extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'equipments',
        'imagesInfo'
    ];

    public function transform(TypeOfEquipment $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'quantity' => $model->quantity,
            'quantity_can_rent' => $model->quantity_can_rent,
            'price' => $model->price,
            'unit' => $model->unit,
            'describe' => $model->describe ?? null,
        ];
    }

    public function includeEquipments(TypeOfEquipment $model) :  Collection|NullResource
    {
        $data = $model->relationLoaded('equipments') ? $model->equipments : null;

        return ($data && $data->isNotEmpty()) ? $this->collection($data, new EquipmentTransformers())
            : $this->null();
    }

    public function includeImagesInfo(TypeOfEquipment $model) : Item|NullResource
    {
        $data = $model->relationLoaded('imagesInfo') ? $model->imagesInfo : null;

        return $data ? $this->item($data, new ImageInfoTransformer()) : $this->null();
    }
}

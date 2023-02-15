<?php

namespace App\Transformers\Recoup;

use App\Models\LendReturnEquipments\LendReturnEquipmentDetails;
use App\Transformers\Equipment\EquipmentTransformers;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class RecoupTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
    ];

    protected array $availableIncludes = [
    ];

    public function transform(LendReturnEquipmentDetails $model): array
    {
        return [

        ];
    }
}

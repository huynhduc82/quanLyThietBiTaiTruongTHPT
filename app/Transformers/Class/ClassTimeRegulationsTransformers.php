<?php

namespace App\Transformers\Class;

use App\Models\Class\ClassTimeRegulations;
use League\Fractal\TransformerAbstract;

class ClassTimeRegulationsTransformers extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(ClassTimeRegulations $model): array
    {
        return [
            'id' => $model->id,
            'lesson' => 'Tiết ' . $model->lesson,
            'start' => $model->start,
            'end' => $model->end,
        ];
    }
}

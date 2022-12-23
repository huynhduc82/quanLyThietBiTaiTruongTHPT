<?php

namespace App\Transformers\Grades;

use App\Models\Grades\Grade;
use League\Fractal\TransformerAbstract;

class GradeTransformers extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Grade $model): array
    {
        return [
            'id' => $model->id,
            'name' => 'Khối ' . $model->name,
        ];
    }
}

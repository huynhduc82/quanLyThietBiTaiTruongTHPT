<?php

namespace App\Transformers\Class;

use App\Models\Class\Classes;
use App\Models\Equipments\Equipment;
use App\Transformers\EquipmentStatus\EquipmentStatusTransformers;
use App\Transformers\Grades\GradeTransformers;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class ClassTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'grade',
    ];

    public function transform(Classes $model): array
    {
        return [
            'id' => $model->id,
            'grade_id' => $model->grade_id,
            'name' => 'Lớp ' . $model->name,
            'number_of_pupils' => $model->number_of_pupils,
        ];
    }

    public function includeGrade(Classes $model): Item|NullResource
    {
        $data = $model->relationLoaded('grade') ? $model->grade : null;

        return $data ? $this->item($data, new GradeTransformers()) : $this->null();
    }
}

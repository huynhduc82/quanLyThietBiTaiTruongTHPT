<?php

namespace App\Transformers\Course;

use App\Models\Courses\Courses;
use App\Transformers\Grades\GradeTransformers;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class CourseTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'grade'
    ];

    public function transform(Courses $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'grade_id' => $model->grade_id,
        ];
    }

    public function includeGrade(Courses $model): Item|NullResource
    {
        $data = $model->relationLoaded('grade') ? $model->grade : null;

        return $data ? $this->item($data, new GradeTransformers()) : $this->null();
    }
}

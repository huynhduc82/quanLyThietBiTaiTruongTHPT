<?php

namespace App\Transformers\Course;

use App\Models\Courses\CoursesDetails;
use League\Fractal\TransformerAbstract;

class CourseDetailsTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
    ];

    public function transform(CoursesDetails $model): array
    {
        return [
            'id' => $model->id,
            'course_id' => $model->course_id,
            'lesson' => 'Bài: ' . $model->lesson,
            'describe' => $model->describe ?? null,
            'need_equipment' => $model->need_equipment,
        ];
    }
}

<?php

namespace App\Transformers\Course;

use App\Models\Courses\Courses;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Transformers\Equipment\EquipmentTransformers;
use App\Transformers\Grades\GradeTransformers;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\NullResource;
use League\Fractal\TransformerAbstract;

class CourseTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [
        'grade',
        'courseDetails'
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

    public function includeCourseDetails(Courses $model) :  Collection|NullResource
    {
        $data = $model->relationLoaded('courseDetails') ? $model->courseDetails : null;

        return ($data && $data->isNotEmpty()) ? $this->collection($data, new CourseDetailsTransformer())
            : $this->null();
    }
}

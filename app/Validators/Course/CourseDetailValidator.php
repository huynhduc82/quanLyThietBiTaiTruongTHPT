<?php

namespace App\Validators\Course;

use App\Models\Courses\Courses;
use App\Models\Courses\CoursesDetails;
use App\Models\Grades\Grade;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class CourseDetailValidator extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'lesson' => [
                'required',
                'string',
                'max:' . CoursesDetails::LESSON_MAX_LENGTH,
                'min:' . CoursesDetails::LESSON_MIN_LENGTH,
            ],
            'describe' => [
                'nullable',
                'string',
                'max:' . CoursesDetails::DESCRIBE_MAX_LENGTH,
                'min:' . CoursesDetails::DESCRIBE_MIN_LENGTH,
            ],
            'need_equipment' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function ruleUpdate(): array
    {
        // TODO: Implement ruleUpdate() method.
        return $this->ruleCreate();
    }

    public function message(): array
    {
        // TODO: Implement message() method.
        return [

        ];
    }
}

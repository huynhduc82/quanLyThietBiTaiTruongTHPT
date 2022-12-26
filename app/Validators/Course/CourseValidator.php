<?php

namespace App\Validators\Course;

use App\Models\Courses\Courses;
use App\Models\Grades\Grade;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class CourseValidator extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'name' => [
                'required',
                'string',
                'max:' . Courses::NAME_MAX_LENGTH,
                'min:' . Courses::NAME_MIN_LENGTH,
            ],
            'grade_id' => [
                'required',
                'int',
                Rule::exists(Grade::class, 'id')->whereNull('deleted_at'),
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

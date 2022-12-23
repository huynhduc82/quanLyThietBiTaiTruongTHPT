<?php

namespace App\Validators\Classes;

use App\Models\Class\Classes;
use App\Models\Grades\Grade;
use App\Models\Rooms\Room;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class ClassValidator extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'grade_id' => [
                'required',
                'int',
                Rule::exists(Grade::class, 'id')->whereNull('deleted_at'),
            ],
            'name' => [
                'required',
                'string',
                'max:' . Classes::NAME_MAX_LENGTH,
                'min:' . Classes::NAME_MIN_LENGTH,
            ],
            'number_of_pupils' => [
                'required',
                'int',
                'max:' . Classes::NUMBER_OF_PUPILS_MAX,
                'min:' . Classes::NUMBER_OF_PUPILS_MIN,
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

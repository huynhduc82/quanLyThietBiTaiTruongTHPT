<?php

namespace App\Validators\Grades;

use App\Models\Grades\Grade;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;

class GradeValidators extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'name' => [
                'required',
                'string',
                'max:' . Grade::NAME_MAX_LENGTH,
                'min:' . Grade::NAME_MIN_LENGTH,
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

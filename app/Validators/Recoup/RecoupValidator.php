<?php

namespace App\Validators\Recoup;

use App\Models\User;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class RecoupValidator extends AbstractValidator implements IValidatorMessage, IValidatorRuleCreate, IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
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

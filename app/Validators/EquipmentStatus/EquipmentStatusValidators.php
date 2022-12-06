<?php

namespace App\Validators\EquipmentStatus;

use App\Models\EquipmentStatus\EquipmentStatus;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;

class EquipmentStatusValidators extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'condition_details' => [
                'required',
                'string',
                'min:' . EquipmentStatus::DETAILS_MIN_LENGTH,
                'max:' . EquipmentStatus::DETAILS_MAX_LENGTH,
            ],
            'can_continue_to_use' => [
                'required',
                'boolean',
            ],
            'number_of_repairs' => [
                'nullable',
                'int',
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

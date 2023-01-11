<?php

namespace App\Validators\LendReturnEquipments;

use App\Models\User;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class ReturnEquipmentValidators extends AbstractValidator implements IValidatorMessage, IValidatorRuleCreate, IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'equipment' => [
                'required',
                'array'
            ],
            'equipment.*.type_of_equipment_id' => [
                'required',
                'int',
//                Rule::exists(TypeOfEquipment::class, 'id')->whereNull('deleted_at'),
            ],
            'equipment.*.quantity' => [
                'required',
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

<?php

namespace App\Validators\LendReturnEquipments;

use App\Models\Rooms\Room;
use App\Models\User;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class LendEquipmentValidators extends AbstractValidator implements IValidatorMessage, IValidatorRuleCreate, IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'user_id' => [
                'required',
                'int',
                Rule::exists(User::class, 'id')->whereNull('deleted_at'),
            ],
            'return_appointment_time' => [
                'required',
                'date',
            ],
            'room_id' => [
                'nullable',
                'int',
                Rule::exists(Room::class, 'id')->whereNull('deleted_at'),
            ],
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
                'integer',

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

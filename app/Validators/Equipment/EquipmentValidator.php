<?php

namespace App\Validators\Equipment;

use App\Models\Equipments\Equipment;
use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\Rooms\Room;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class EquipmentValidator extends AbstractValidator implements IValidatorMessage, IValidatorRuleCreate, IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'room_id' => [
                'nullable',
                'int',
                Rule::exists(Room::class, 'id')->whereNull('deleted_at'),
            ],
            'equipment_status_id' => [
                'nullable',
                'int',
                Rule::exists(EquipmentStatus::class, 'id')->whereNull('deleted_at'),
            ],
            'type_of_equipment_id' => [
                'nullable',
                'int',
                Rule::exists(TypeOfEquipment::class, 'id')->whereNull('deleted_at'),
            ],
            'name' => [
                'required',
                'string',
                'min:' . Equipment::NAME_MIN_LENGTH,
                'max:' . Equipment::NAME_MAX_LENGTH,
            ],
            'can_rent' => [
                'nullable',
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

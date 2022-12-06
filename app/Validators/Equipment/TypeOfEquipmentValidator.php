<?php

namespace App\Validators\Equipment;

use App\Models\ImageInfos\ImageInfo;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;

class TypeOfEquipmentValidator extends AbstractValidator implements IValidatorRuleUpdate, IValidatorRuleCreate, IValidatorMessage
{
    public function ruleCreate(): array
    {

        // TODO: Implement ruleCreate() method.
        return [
            'name' => [
                'required',
                'string',
                'min:' . TypeOfEquipment::NAME_MIN_LENGTH,
                'max:' . TypeOfEquipment::NAME_MAX_LENGTH,
            ],
            'price' => [
                'required',
                'int',
                'min:' . TypeOfEquipment::PRICE_MIN,
                'max:' . TypeOfEquipment::PRICE_MAX,
            ],
            'unit' => [
                'required',
                'string',
                'min:' . TypeOfEquipment::UNIT_MIN_LENGTH,
                'max:' . TypeOfEquipment::UNIT_MAX_LENGTH,
            ],
            'describe' => [
                'nullable',
                'string',
                'min:' . TypeOfEquipment::DESCRIBE_MIN_LENGTH,
                'max:' . TypeOfEquipment::DESCRIBE_MAX_LENGTH,
            ],
            'images' => [
                'nullable',
                'image',
                'mimes:' . implode(',', ImageInfo::IMAGE_MIMES),
                'max:' . ImageInfo::IMAGE_MAX_SIZE,
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

<?php

namespace App\Validators\SpecifyTheNumberOfEquipments;

use App\Models\Courses\CoursesDetails;
use App\Models\Equipments\Equipment;
use App\Models\Grades\Grade;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class SpecifyTheNumberOfEquipmentsValidator extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'course_details_id' => [
                'required',
                'string',
                Rule::exists(CoursesDetails::class, 'id'),
            ],
            'equipment_id' => [
                'required',
                'string',
                Rule::exists(TypeOfEquipment::class, 'id'),
            ],
            'quantity' => [
                'required',
                'string',
            ],
        ];
    }

    public function ruleUpdate(): array
    {
        return [
            'quantity' => [
                'required',
                'string',
            ],
        ];
    }

    public function message(): array
    {
        // TODO: Implement message() method.
        return [

        ];
    }
}

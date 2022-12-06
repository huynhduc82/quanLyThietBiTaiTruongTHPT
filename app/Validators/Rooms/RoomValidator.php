<?php

namespace App\Validators\Rooms;

use App\Models\Rooms\Room;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;

class RoomValidator extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
    // TODO: Implement ruleCreate() method.
    return [
        'name' => [
            'required',
            'string',
            'min:' . Room::NAME_MIN_LENGTH,
            'max:' . Room::NAME_MAX_LENGTH,
        ],
        'can_rent' => [
            'required',
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

<?php

namespace App\Validators\Chat;

use App\Models\Chat\ChatMessage;
use App\Models\Class\Classes;
use App\Models\Grades\Grade;
use App\Models\Rooms\Room;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;
use Illuminate\Validation\Rule;

class ChatValidator extends AbstractValidator implements IValidatorMessage,IValidatorRuleCreate,IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'message' => [
                'required',
                'string',
                'min:' . ChatMessage::MESSAGE_MIN_LENGTH,
                'max:' . ChatMessage::MESSAGE_MAX_LENGTH,
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

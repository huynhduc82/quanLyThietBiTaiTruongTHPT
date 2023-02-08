<?php

namespace App\Validators\User;

use App\Models\ImageInfos\ImageInfo;
use App\Models\User;
use App\Validators\AbstractValidator;
use App\Validators\Contracts\IValidatorMessage;
use App\Validators\Contracts\IValidatorRuleCreate;
use App\Validators\Contracts\IValidatorRuleUpdate;

class UserProfileValidator extends AbstractValidator implements IValidatorMessage, IValidatorRuleCreate, IValidatorRuleUpdate
{
    public function ruleCreate(): array
    {
        // TODO: Implement ruleCreate() method.
        return [
            'name' => [
                'required',
                'string',
                'min:' . User::NAME_MIN_LENGTH,
                'max:' . User::NAME_MAX_LENGTH,
            ],
            'phone_number' => [
                'required',
                'string',
                'min:' . User::PHONE_NUMBER_MIN_LENGTH,
                'max:' . User::PHONE_NUMBER_MAX_LENGTH,
            ],
            'date_of_birth' => [
                'required',
                'date',
            ],
            'identification' => [
                'nullable',
                'string',
                'min:' . User::IDENTIFICATION_MIN_LENGTH,
                'max:' . User::IDENTIFICATION_MAX_LENGTH,
            ],
            'address' => [
                'nullable',
                'string',
                'min:' . User::ADDRESS_MIN_LENGTH,
                'max:' . User::ADDRESS_MAX_LENGTH,
            ],
            'email' => [
                'required',
                'email',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:' . implode(',', ImageInfo::IMAGE_MIMES),
                'max:' . ImageInfo::IMAGE_MAX_SIZE,
            ],
            'background' => [
                'nullable',
                'image',
                'mimes:' . implode(',', ImageInfo::IMAGE_MIMES),
                'max:' . ImageInfo::IMAGE_MAX_SIZE,
            ],
            'facebook' => [
                'nullable',
                'string',
                'min:' . User::LINK_MIN_LENGTH,
                'max:' . User::LINK_MAX_LENGTH,
            ],
            'twitter' => [
                'nullable',
                'string',
                'min:' . User::LINK_MIN_LENGTH,
                'max:' . User::LINK_MAX_LENGTH,
            ],
            'instagram' => [
                'nullable',
                'string',
                'min:' . User::LINK_MIN_LENGTH,
                'max:' . User::LINK_MAX_LENGTH,
            ],
            'courses' => [
                'nullable',
                'array',
            ]
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

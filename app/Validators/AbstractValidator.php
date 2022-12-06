<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AbstractValidator extends LaravelValidator
{
    private function makeRules() : void
    {
        $rules = $this->rules;

        if (method_exists($this, 'ruleCreate')) {
            $rules[ValidatorInterface::RULE_CREATE] = $this->ruleCreate();
        }

        if (method_exists($this, 'ruleUpdate')) {
            $rules[ValidatorInterface::RULE_UPDATE] = $this->ruleUpdate();
        }

        $this->setRules($rules);
    }

    private function makeMessages(): void
    {
        $messages = $this->messages;

        if (method_exists($this, 'messages')) {
            $messages = $this->messages();
        }

        $this->setMessages($messages);
    }

    public function passes($action = null): bool
    {
        $this->makeRules();
        $this->makeMessages();

        return parent::passes($action);
    }

    public function getRules($action = null): array
    {
        $this->makeRules();

        return parent::getRules($action);
    }

    public function getMessages(): array
    {
        $this->makeMessages();

        return parent::getMessages();
    }
}

<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class LinkValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'url' => ['required', 'active_url'],
            'description' => ['required', 'string'],
        ],
    ];
}

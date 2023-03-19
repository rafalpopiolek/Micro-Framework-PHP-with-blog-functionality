<?php

declare(strict_types = 1);

namespace App\Validators;

class LoginValidator extends Validator
{
    public function __construct(array $data, array $validationFields)
    {
        parent::__construct($data, $validationFields);
    }

    protected array $fieldsToValidate = [
        'username',
        'password'
    ];
}

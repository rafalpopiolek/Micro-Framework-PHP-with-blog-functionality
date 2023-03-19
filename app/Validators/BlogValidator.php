<?php

declare(strict_types = 1);

namespace App\Validators;

class BlogValidator extends Validator
{
    public function __construct(array $data, array $validationFields)
    {
        parent::__construct($data, $validationFields);
    }

    protected array $fieldsToValidate = [
        'text',
    ];
}

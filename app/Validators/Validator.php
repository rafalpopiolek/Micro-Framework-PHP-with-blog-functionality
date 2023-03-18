<?php

declare(strict_types = 1);

namespace App\Validators;

class Validator
{
    public function validateString(string $value, int $min = 5, int $max = 2000): string|array
    {
        $errors = [];

        $value = htmlspecialchars($value);

        $value = trim($value);

        if (empty($value)) {
            $errors['text'][] = 'The text is required';
        }

        if (strlen($value) < $min) {
            $errors['text'][] = "The text must contain a min of $min characters";
        }

        if (strlen($value) > $max) {
            $errors['text'][] = "The text must contain a maximum of $max characters";
        }

        if (! empty($errors)) {
            return $errors;
        }

        return $value;
    }
}

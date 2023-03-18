<?php

declare(strict_types = 1);

namespace App\Validators;

class Validator
{
    public array $errors = [];

    public function validateString(string $value, int $min = 5, int $max = 2000): string|array
    {
        $value = htmlspecialchars($value);

        $value = trim($value);

        if (empty($value)) {
            $this->errors['text'][] = 'The text is required';
        }

        if (strlen($value) < $min) {
            $this->errors['text'][] = "The text must contain a min of $min characters";
        }

        if (strlen($value) > $max) {
            $this->errors['text'][] = "The text must contain a maximum of $max characters";
        }

        if (! empty($this->errors)) {
            return $this->errors;
        }

        return $value;
    }

    public function validateName(string $value, int $min = 1, int $max = 45): string|array
    {
        $value = htmlspecialchars($value);

        if (empty($value)) {
            $this->errors['username'][] = 'The username is required';
        }

        if (strlen($value) < $min) {
            $this->errors['username'][] = "The username must contain a min of $min characters";
        }

        if (strlen($value) > $max) {
            $this->errors['username'][] = "The username must contain a maximum of $max characters";
        }

        if (! empty($this->errors)) {
            return $this->errors;
        }

        return $value;
    }

    public function validatePassword(string $password): string|array
    {
        $value = htmlspecialchars($password);

        if (empty($value)) {
            $this->errors['password'][] = 'The password is required';
        }

        if (! empty($this->errors)) {
            return $this->errors;
        }

        return $value;
    }
}

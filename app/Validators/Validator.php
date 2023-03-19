<?php

declare(strict_types = 1);

namespace App\Validators;

abstract class Validator
{
    protected array $fieldsToValidate = [];

    protected array $errors = [];

    public function __construct(
        protected array $data,
        protected array $validationFields,
    ) {
        $this->validate();
    }

    public function validate(): void
    {
        foreach ($this->validationFields as $fieldName => $rules) {
            foreach ($rules as $ruleName => $ruleValue) {
                if (! in_array($fieldName, $this->fieldsToValidate)) {
                    $this->addError($fieldName, "Unknown validation name: $ruleName");
                    continue;
                }

                $methodName = $ruleName . 'Rule';
                if (! method_exists(self::class, $methodName)) {
                    $this->addError($fieldName, "Rule doesn't exist: $methodName");
                    continue;
                }

                $this->$methodName($fieldName, $ruleValue);
            }
        }
    }

    protected function addError(string $fieldName, string $message): void
    {
        $this->errors[$fieldName][] = $message;
    }

    public function fails(): bool
    {
        return ! empty($this->errors);
    }

    public function getErrors(): array
    {
        if ($this->fails()) {
            return $this->errors;
        } else {
            return [];
        }
    }

    public function getValidated(): array
    {
        if (! $this->fails()) {
            $validated = [];

            foreach ($this->fieldsToValidate as $item) {
                $validated[$item] = $this->data[$item];
            }

            return $validated;
        }

        return [];
    }

    protected function requiredRule(string $fieldName, bool $ruleValue): void
    {
        if ($ruleValue && empty($this->data[$fieldName])) {
            $this->addError($fieldName, "The $fieldName field is required");
        }
    }

    protected function minRule(string $fieldName, int $min): void
    {
        if (isset($this->data[$fieldName]) && mb_strlen($this->data[$fieldName]) < $min) {
            $this->addError($fieldName, "The $fieldName field must be at least $min characters long");
        }
    }

    protected function maxRule(string $fieldName, int $max): void
    {
        if (isset($this->data[$fieldName]) && mb_strlen($this->data[$fieldName]) > $max) {
            $this->addError($fieldName, "The $fieldName field cannot be longer than $max characters");
        }
    }
}

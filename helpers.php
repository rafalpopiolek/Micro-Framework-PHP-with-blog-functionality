<?php

declare(strict_types = 1);

// In this file I put all helper functions

function dd(mixed $value): void
{
    echo "<pre style='border: 1px solid black; background-color: lightgray; padding: 5px;'>";
    print_r($value);
    echo "</pre>";
//    exit();
}


function isDevelopment(string $environment): bool
{
    if ($environment === \App\Enums\Environment::LOCAL->value) {
        return true;
    }
    return false;
}

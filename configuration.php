<?php

declare(strict_types = 1);

use App\Enums\Environment;

return [
    'app' => [
        'name' => 'Venture - Recruitment Task',
        'environment' => Environment::LOCAL->value,
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'database' => 'venture',
    ],
];

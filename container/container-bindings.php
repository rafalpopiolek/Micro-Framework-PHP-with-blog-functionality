<?php

declare(strict_types = 1);

use App\Config;
use App\DatabaseConnection;

return [
    Config::class             => Di\create(Config::class)->constructor(
        require __DIR__ . '/../configuration.php'
    ),
    DatabaseConnection::class => function (Config $config) {
        return new DatabaseConnection($config);
    }
];

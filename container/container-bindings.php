<?php

declare(strict_types = 1);

use App\Config;
use App\DatabaseConnection;
use DI\Container;

return [
    Config::class             => Di\create()->constructor(
        require __DIR__ . '/../configuration.php'
    ),
    DatabaseConnection::class => function (Container $container) {
        return new DatabaseConnection(
            $container->get(Config::class)->db
        );
    },
];

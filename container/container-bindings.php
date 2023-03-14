<?php

declare(strict_types = 1);

use App\Config;
use App\DatabaseConnection;
use App\Request;
use DI\Container;

return [
    Request::class            => Di\create()->constructor(
        $_GET,
        $_POST,
        $_SERVER
    ),
    Config::class             => Di\create()->constructor(
        require __DIR__ . '/../configuration.php'
    ),
    DatabaseConnection::class => function (Container $container) {
        return new DatabaseConnection(
            $container->get(Config::class)->db
        );
    },
];

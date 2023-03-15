<?php

declare(strict_types = 1);

use App\Application;
use App\Config;
use App\DatabaseConnection;
use App\Request;
use App\Router;
use DI\Container;

/**
 * This file should contain all container bindings
 */
return [
    Application::class        => function (Container $container) {
        return new Application(
            $container->get(Router::class),
            $container->get(Config::class),
            // PUT, PATCH and DELETE are available after adding <input name="_method" value"REQUEST_TYPE"> to form
            // If input is set use it, otherwise get the standard REQUEST_METHOD
            [
                'uri'    => $_SERVER['REQUEST_URI'],
                'method' => $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']
            ],
        );
    },
    Request::class            => Di\create()->constructor(
        $_GET,
        $_POST,
        $_SERVER
    ),
    Router::class             => function (Container $container) {
        return new Router($container);
    },
    Config::class             => Di\create()->constructor(
        require __DIR__ . '/../configuration.php'
    ),
    DatabaseConnection::class => function (Container $container) {
        return new DatabaseConnection(
            $container->get(Config::class)->db
        );
    },
];

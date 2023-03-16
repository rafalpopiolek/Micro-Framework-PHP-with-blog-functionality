<?php

declare(strict_types = 1);

use App\Application;
use App\Config;
use App\DatabaseConnection;
use App\Repositories\BlogRepository;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Request;
use App\Router;
use DI\Container;

/**
 * This file should contain all container bindings
 */
return [
    Application::class => function (Container $container) {
        return new Application(
            $container->get(Router::class),
            $container->get(Config::class),
            // Make PUT, PATCH or DELETE request by adding <input name="_method" value"REQUEST_TYPE">
            [
                'uri' => $_SERVER['REQUEST_URI'],
                'method' => $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']
            ],
        );
    },
    Request::class => Di\create()->constructor(
        $_GET,
        $_POST,
        $_SERVER
    ),
    Router::class => function (Container $container) {
        return new Router(
            $container,
            $container->get(Request::class),
        );
    },
    Config::class => Di\create()->constructor(
        require __DIR__ . '/../configuration.php'
    ),
    DatabaseConnection::class => function (Container $container) {
        return new DatabaseConnection(
            $container->get(Config::class)->db
        );
    },
    BlogRepositoryInterface::class => Di\autowire(BlogRepository::class),
];
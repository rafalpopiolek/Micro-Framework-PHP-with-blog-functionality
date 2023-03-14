<?php

declare(strict_types = 1);

// This should be disabled in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers.php';
require __DIR__ . '/../routes/web.php';

use App\Application;
use App\Config;
use App\Router;
use DI\Container;

$container = new Container();

$builder = new DI\ContainerBuilder();

$builder->addDefinitions(__DIR__ . '/../container/container-bindings.php');

$container = $builder->build();

const VIEW_PATH = __DIR__ . '/../templates';

$config = require __DIR__ . '/../configuration.php';

$router = new Router($container);

defineRoutes($router);

$app = new Application(
    $router,
    new Config($config),
    [
        'uri'    => $_SERVER['REQUEST_URI'],
        'method' => $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']
    ],
);

$app->init();

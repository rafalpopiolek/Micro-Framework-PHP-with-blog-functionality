<?php

declare(strict_types = 1);

// This should be disabled in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../helpers.php';

use App\Router;
use App\Application;
use App\Controllers\HomeController;
use App\Exceptions\RouteNotFoundException;

$application = new Application();

$router = new Router();

try {
    $router
        ->get('/', function () {
            dd($_SERVER);
        })
        ->get('/?action=login', function () {
            echo "Login";
        })
        ->post('/?action=register', [HomeController::class, 'index'])
        ->put('/?action=update', [HomeController::class, 'update']);

    $router->resolve(
        requestUri: $_SERVER['REQUEST_URI'],
        requestMethod: $_POST['_method'] ?? $_SERVER['REQUEST_METHOD']
    );
} catch (RouteNotFoundException $e) {
    dd($e);
} catch (Exception $e) {
    dd($e);
}

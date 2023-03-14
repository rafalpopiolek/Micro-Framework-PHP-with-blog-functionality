<?php

declare(strict_types = 1);

use App\Controllers\HomeController;
use App\Router;

function defineRoutes(Router $router): void
{
    $router
        ->get('/', function () {
//            dd($_SERVER);
        })
        ->get('/?action=login', function () {
            echo "Login";
        })
        ->get('/?action=register', [HomeController::class, 'index'])
        ->put('/?action=update', [HomeController::class, 'update']);
}

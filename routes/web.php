<?php

declare(strict_types = 1);

use App\Controllers\HomeController;
use App\Router;

// All your routes put here
function defineRoutes(Router $router): void
{
    $router
        ->get('/', function (\App\Request $request) {
            dd($request);
        })
        ->get('/?action=login', function () {
            echo "Login";
        })
        ->get('/?action=register', [HomeController::class, 'index'])
        ->post('/?action=update', [HomeController::class, 'update']);
}

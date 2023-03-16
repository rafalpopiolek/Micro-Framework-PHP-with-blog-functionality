<?php

declare(strict_types = 1);

use App\Controllers\BlogController;
use App\Router;

// All your routes put here
function defineRoutes(Router $router): void
{
    $router
        ->get('/', [BlogController::class, 'index'])
        ->post('/?action=update', [BlogController::class, 'update']);
}

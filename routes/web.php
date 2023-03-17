<?php

declare(strict_types = 1);

use App\Controllers\BlogController;
use App\Controllers\HomeController;
use App\Router;

// All your routes put here
function defineRoutes(Router $router): void
{
    $router
        ->get('/', [HomeController::class, 'index'])
        ->get('/blog', [BlogController::class, 'index'])
        ->get('/blog/?action=load', [BlogController::class, 'load'])
        ->get('/blog/?action=create', [BlogController::class, 'create'])
        ->post('/blog', [BlogController::class, 'store'])
        ->delete('/blog/?action=delete', [BlogController::class, 'destroy']);
}

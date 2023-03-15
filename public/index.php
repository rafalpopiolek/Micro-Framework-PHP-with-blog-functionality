<?php

declare(strict_types = 1);

// This should be disabled in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Application;

const VIEW_PATH = __DIR__ . '/../templates';
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/helpers.php';
require BASE_PATH . '/routes/web.php';

// Get container
$container = require BASE_PATH . 'container/container.php';

// Get Application from DI container
/** @var Application $app */
$app = $container->get(Application::class);

// Bootstrap application
$app->init();

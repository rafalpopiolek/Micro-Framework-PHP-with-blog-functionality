<?php

declare(strict_types = 1);

// This should be disabled in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const VIEW_PATH = __DIR__ . '/../templates';
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/helpers.php';
require BASE_PATH . '/routes/web.php';

use App\Application;

$container = require BASE_PATH . 'container/container.php';

$config = require BASE_PATH . '/configuration.php';

$app = $container->get(Application::class);

$app->init();

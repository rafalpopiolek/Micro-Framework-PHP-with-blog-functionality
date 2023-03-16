<?php

declare(strict_types = 1);

const BASE_PATH = __DIR__ . '/../';
const VIEW_PATH = __DIR__ . '/../templates/';

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/routes/web.php';
require BASE_PATH . '/helpers.php';

use App\Application;
use App\Enums\Environment;

// Only in local environment display errors
if (isDevelopment(Environment::LOCAL->value)) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Get container
$container = require BASE_PATH . 'container/container.php';

// Get Application from DI container
/** @var Application $app */
$app = $container->get(Application::class);

// Bootstrap application

// TODO: Pomyśleć jak rozwiązać sprawę z modelami
// TODO: Może bez nich tylko repozytoria i serwisy?
// TODO: Zaimplmentować obsługę widoków - taka jak z PMS - Uni
// TOOD: Jak narazie tyle - nie przychodzi mi nic do głowy! :/

$app->init();
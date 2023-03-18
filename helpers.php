<?php

declare(strict_types = 1);

use App\Enums\Environment;
use App\Enums\UserRoles;

function dd(mixed $value): void
{
    echo "<pre style='border: 1px solid black; background-color: lightgray; padding: 5px;'>";
    print_r($value);
    echo "</pre>";
    exit();
}

function isDevelopment(string $environment): bool
{
    if ($environment === Environment::LOCAL->value) {
        return true;
    }
    return false;
}

function redirect_to(string $path, int $code): void
{
    http_response_code($code);
    header("Location: $path");
    exit;
}

function isAuth(): bool
{
    if (isset($_SESSION['user'])) {
        return true;
    }
    return false;
}

function isAdmin(): bool
{
    if (isAuth()) {
        if ($_SESSION['user']['permission'] === UserRoles::ADMIN->value) {
            return true;
        }
        return false;
    }

    return false;
}

function getCurrentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

function showErrorPage(string $path, int $code): void
{
    http_response_code($code);
    require_once VIEW_PATH . $path;
    die();
}

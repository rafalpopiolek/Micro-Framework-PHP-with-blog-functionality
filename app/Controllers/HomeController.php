<?php

declare(strict_types = 1);

namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;

class HomeController
{
    #[NoReturn]
    public function index(array $data): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    #[NoReturn]
    public function update(): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }
}

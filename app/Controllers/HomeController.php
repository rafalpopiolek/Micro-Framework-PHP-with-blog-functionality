<?php

declare(strict_types = 1);

namespace App\Controllers;

class HomeController
{
    public function index(array $data): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }

    public function update(array $data): void
    {
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }
}

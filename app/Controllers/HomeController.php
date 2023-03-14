<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\DatabaseConnection;

readonly class HomeController
{
    public function __construct(private readonly DatabaseConnection $connection)
    {
    }

    public function index(): void
    {
        $this->connection->connect();
    }

    public function update(): void
    {
        //
    }
}

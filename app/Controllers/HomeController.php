<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\DatabaseConnection;
use App\Request;

readonly class HomeController
{
    public function __construct(
        private readonly DatabaseConnection $connection,
    ) {
    }

    public function index(Request $request): void
    {
//        $query = $this->connection->query("SELECT * FROM users");
//        dd($query);
    }

    public function update(): void
    {
        //
    }
}

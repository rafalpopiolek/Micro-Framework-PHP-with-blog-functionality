<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\DatabaseConnection;

readonly class HomeController
{
    public function __construct(private readonly DatabaseConnection $db)
    {
    }

    public function index(): void
    {

    }

    public function update(): void
    {
        //
    }
}

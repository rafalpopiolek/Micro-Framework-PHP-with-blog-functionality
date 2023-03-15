<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\DatabaseConnection;
use App\Request;

class HomeController
{
    public function __construct(private readonly DatabaseConnection $connection)
    {
    }

    public function index(Request $request): void
    {
        dd($request);
    }

    public function update(Request $request): void
    {
        dd($request->getPostParameters());
    }
}

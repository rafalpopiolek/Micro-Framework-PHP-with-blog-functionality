<?php

declare(strict_types = 1);

namespace App;

class DatabaseConnection
{
    public function __construct(private Config $dbConfig)
    {
    }

    public function connect(): void
    {
        echo "Connected to database!";
    }
}
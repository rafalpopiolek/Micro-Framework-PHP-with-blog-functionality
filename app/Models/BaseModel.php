<?php

declare(strict_types = 1);

namespace App\Models;

abstract readonly class BaseModel
{
    public function __construct(private DatabaseConnection $db)
    {
    }
}

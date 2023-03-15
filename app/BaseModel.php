<?php

declare(strict_types = 1);

namespace App;

abstract class BaseModel
{
    public function __construct(protected DatabaseConnection $db)
    {
    }
}

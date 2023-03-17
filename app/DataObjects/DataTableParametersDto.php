<?php

declare(strict_types = 1);

namespace App\DataObjects;

readonly class DataTableParametersDto
{
    public function __construct(
        public int $start,
        public int $length,
        public string $orderBy,
        public string $orderDir,
        public string $search,
        public int $draw,
    ) {
    }
}

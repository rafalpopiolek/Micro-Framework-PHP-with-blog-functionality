<?php

declare(strict_types = 1);

namespace App\Repositories\Contracts;

interface BlogRepositoryInterface
{
    public function getAll(): array;

    public function create(string $text): bool;
}

<?php

declare(strict_types = 1);

namespace App\Repositories\Contracts;

interface BlogRepositoryInterface
{
    public function getAll(): array;

    public function create(string $text): bool;

    public function getPaginated(
        int $start,
        int $length,
        string $search,
        string $orderBy,
        string $orderDir = 'ASC',
    );

    public function count(): int;
}

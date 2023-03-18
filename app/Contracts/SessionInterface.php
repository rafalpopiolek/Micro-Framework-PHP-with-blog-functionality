<?php

declare(strict_types = 1);

namespace App\Contracts;

interface SessionInterface
{
    public function start(): void;

    public function put(string $key, mixed $value): void;

    public function get(string $key): mixed;

    public function forget(string $key);
}

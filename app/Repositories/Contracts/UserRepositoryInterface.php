<?php

declare(strict_types = 1);

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{

    public function findByName(string $username);

    public function register(string $username, string $password, string $permission, string $readonly): bool;

}

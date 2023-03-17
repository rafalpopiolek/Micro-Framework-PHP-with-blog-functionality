<?php

declare(strict_types = 1);

namespace App\Services;

use App\Enums\UserRoles;
use App\Repositories\Contracts\UserRepositoryInterface;

readonly class RegisterService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function register(string $username, string $password): bool
    {
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $permission = UserRoles::USER->value;
        $readonly = 'YES';

        if ($this->userRepository->register($username, $password, $permission, $readonly)) {
            return true;
        }

        return false;
    }
}

<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

readonly class LoginService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function logIn(string $username, string $password): bool
    {
        $user = $this->userRepository->findByName($username);

        if ($user) {
            if (! password_verify($password, $user['password'])) {
                return false;
            }

            // Remove password before adding to session
            unset($user['password']);
            $user['username'] = htmlspecialchars($user['username']);
            // Store user information for quick access
            $_SESSION['user'] = $user;

            return true;
        }

        return false;
    }

    public function logout(): void
    {
        if (isset($_SESSION['user'])) {
            session_unset();
            session_destroy();
        }
    }
}

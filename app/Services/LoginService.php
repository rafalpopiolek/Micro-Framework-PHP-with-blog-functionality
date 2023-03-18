<?php

declare(strict_types = 1);

namespace App\Services;

use App\Contracts\SessionInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

readonly class LoginService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private SessionInterface $session,
    ) {
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

            // Store user information for quick access
            $this->session->put('user', $user);

            return true;
        }

        return false;
    }

    public function logout(): void
    {
        $this->session->forget('user');
    }
}

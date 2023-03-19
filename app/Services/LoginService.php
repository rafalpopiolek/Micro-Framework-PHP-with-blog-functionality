<?php

declare(strict_types = 1);

namespace App\Services;

use App\Contracts\SessionInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Request;
use App\Validators\LoginValidator;

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

            // Protect app from displaying data that the user has provided
            $user['username'] = htmlspecialchars($user['username']);

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

    public function validate(Request $request): LoginValidator
    {
        return new LoginValidator(
            data: [
                'username' => $request->postParam('username'),
                'password' => $request->postParam('password'),
            ],
            validationFields: [
                'username' => [
                    'required' => true,
                    'min' => 3,
                    'max' => 45,
                ],
                'password' => [
                    'required' => true,
                    'min' => 5,
                    'max' => 255,
                ],
            ]
        );
    }
}

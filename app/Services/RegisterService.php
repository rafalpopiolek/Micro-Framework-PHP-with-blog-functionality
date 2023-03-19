<?php

declare(strict_types = 1);

namespace App\Services;

use App\Enums\UserRoles;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Request;
use App\Validators\LoginValidator;

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

    /**
     * Because register form looks the same as Login
     * I decided to use the same validator as in login service
     */
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

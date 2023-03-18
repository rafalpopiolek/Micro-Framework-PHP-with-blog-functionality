<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Request;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\View;

readonly class AuthController
{
    public function __construct(
        private LoginService $loginService,
        private RegisterService $registerService,
    ) {
    }

    public function loginView(): View
    {
        return View::make('auth/login');
    }

    public function registerView(): View
    {
        return View::make('auth/register');
    }

    public function login(Request $request): void
    {
        if ($this->loginService->logIn(
            $request->postParam('username'),
            $request->postParam('password')
        )
        ) {
            redirect_to('/blog', 200);
        } else {
            redirect_to('/blog/?action=login', 401);
        }
    }

    public function register(Request $request): void
    {
        if ($this->registerService->register(
            $request->postParam('username'),
            $request->postParam('password')
        )) {
            redirect_to('/blog/?action=login', 200);
        }

        redirect_to('/blog/?action=register', 403);
    }

    public function logout(): void
    {
        $this->loginService->logout();

        redirect_to('/blog', 200);
    }
}

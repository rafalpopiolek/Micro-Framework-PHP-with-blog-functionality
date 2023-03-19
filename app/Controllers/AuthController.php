<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Contracts\SessionInterface;
use App\Request;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\View;

readonly class AuthController
{
    public function __construct(
        private LoginService $loginService,
        private RegisterService $registerService,
        private SessionInterface $session,
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
        $validator = $this->loginService->validate($request);

        if ($validator->fails()) {
            $this->session->put('errors', $validator->getErrors());

            redirect_to('/blog/?action=login', 403);
        }

        $data = $validator->getValidated();

        if ($this->loginService->logIn($data['username'], $data['password'])) {
            redirect_to('/blog', 200);
        } else {
            $this->session->put('errors', 'Bad credentials');
            redirect_to('/blog/?action=login', 401);
        }
    }

    public function register(Request $request): void
    {
        $validator = $this->registerService->validate($request);

        if ($validator->fails()) {
            $this->session->put('errors', $validator->getErrors());

            redirect_to('/blog/?action=register', 403);
        }

        $data = $validator->getValidated();

        if ($this->registerService->register($data['username'], $data['password'])) {
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

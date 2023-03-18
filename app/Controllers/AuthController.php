<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Contracts\SessionInterface;
use App\Request;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Validators\Validator;
use App\View;

readonly class AuthController
{
    public function __construct(
        private LoginService $loginService,
        private RegisterService $registerService,
        private Validator $validator,
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
        $username = $this->validator->validateName($request->postParam('username'));
        $password = $this->validator->validatePassword($request->postParam('password'));

        if (! empty($this->validator->errors)) {
            $this->session->put('errors', $this->validator->errors);

            redirect_to('/blog/?action=login', 403);
        }

        if ($this->loginService->logIn($username, $password)) {
            redirect_to('/blog', 200);
        } else {
            $this->session->put('errors', 'Bad credentials');
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

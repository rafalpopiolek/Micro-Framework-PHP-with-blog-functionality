<?php

declare(strict_types = 1);

namespace App;

use App\Contracts\SessionInterface;
use App\Exceptions\SessionException;

readonly class Session implements SessionInterface
{
    public function __construct(private Config $config)
    {
    }

    public function start(): void
    {
        if (! isset($_SESSION)) {
            if (! empty($this->config->session['name'])) {
                session_name($this->config->session['name']);
            } else {
                session_name("VENTURE_LABS_SESSION");
            }

            if (! session_start()) {
                throw new SessionException("Cannot start session");
            }
        }
    }

    public function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function forget(string $key)
    {
        unset($_SESSION[$key]);
    }
}

<?php

declare(strict_types = 1);

namespace App;

readonly class Request
{
    public function __construct(
        private array $get,
        private array $post,
        private array $server,
    ) {
    }

    public function queryParam(string $name)
    {
        return $this->get[$name] ?? null;
    }

    public function postParam(string $name)
    {
        return $this->post[$name];
    }

    public function getRequestMethod(): string
    {
        return strtoupper(
            $this->server['REQUEST_METHOD']
        );
    }

    public function getRequestUri(): string
    {
        return $this->server['REQUEST_URI'] ?? '/';
    }
}

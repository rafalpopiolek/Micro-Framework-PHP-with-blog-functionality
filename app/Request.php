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

    public function getParam(string $name): mixed
    {
        return $this->get[$name] ?? null;
    }

    public function postParam(string $name): mixed
    {
        return $this->post[$name] ?? null;
    }

    public function getQueryParameters(): array
    {
        return $this->get;
    }

    public function getPostParameters(): array
    {
        return $this->post;
    }

    public function getMethod(): string
    {
        return strtoupper(
            $this->server['REQUEST_METHOD']
        );
    }

    public function getUri(): string
    {
        return $this->server['REQUEST_URI'] ?? '/';
    }

    public function getJson(): array
    {
        if ($this->getContentType() === 'application/json') {
            return json_decode(
                file_get_contents('php://input'),
                true
            );
        }

        return [];
    }

    public function getContentType(): ?string
    {
        return $this->server['CONTENT_TYPE'] ?? null;
    }
}

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

    public function getContentType(): ?string
    {
        return $this->server['CONTENT_TYPE'] ?? null;
    }

    public function putPatchData()
    {
        $contentType = $this->server['CONTENT_TYPE'] ?? '';
        $content = file_get_contents('php://input');

        if (str_starts_with($contentType, 'application/json')) {
            return json_decode($content, true);
        } elseif (str_starts_with($contentType, 'application/x-www-form-urlencoded')) {
            parse_str($content, $params);
            return $params;
        } elseif (str_starts_with($contentType, 'multipart/form-data')) {
            $params = [];
            $boundary = $this->getBoundary($contentType);
            $blocks = preg_split("/-+$boundary/", $content);
            array_pop($blocks);

            foreach ($blocks as $id => $block) {
                if (empty($block)) {
                    continue;
                }

                if (str_contains($block, 'application/octet-stream')) {
                    preg_match(
                        '/Content-Disposition: form-data; name="([^"]+)"(?:; filename="([^"]+)")?.*Content-Type: application\/octet-stream.*?\r\n\r\n(.*)/s',
                        $block,
                        $matches
                    );
                    $params[$matches[1]] = $matches[3];
                } else {
                    preg_match('/Content-Disposition: form-data; name="([^"]+)"\r\n\r\n(.*)/s', $block, $matches);
                    $params[$matches[1]] = $matches[2];
                }
            }

            return $params;
        } else {
            return [];
        }
    }

    private function getBoundary($contentType): string
    {
        preg_match('/boundary=([^;]+)/', $contentType, $matches);
        return $matches[1];
    }
}

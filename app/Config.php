<?php

declare(strict_types = 1);

namespace App;

/**
 * @property-read  array $app
 * @property-read array $db
 */
class Config
{
    public function __construct(protected array $config)
    {
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}

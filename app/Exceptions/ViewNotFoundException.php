<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Exception;
use Throwable;

class ViewNotFoundException extends Exception
{
    public function __construct(string $message = "View Not Found | 404", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
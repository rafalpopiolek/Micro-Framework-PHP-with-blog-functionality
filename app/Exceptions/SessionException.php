<?php

declare(strict_types = 1);

namespace App\Exceptions;

use Exception;
use Throwable;

class SessionException extends Exception
{

    public function __construct(string $message = "", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
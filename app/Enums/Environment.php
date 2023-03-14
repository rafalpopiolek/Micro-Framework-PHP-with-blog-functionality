<?php

declare(strict_types = 1);

namespace App\Enums;

enum Environment:string
{
    case LOCAL = 'local';
    case PRODUCTION = 'production';
    case TESTING = 'testing';
}

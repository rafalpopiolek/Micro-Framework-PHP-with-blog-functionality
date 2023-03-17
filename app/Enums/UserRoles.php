<?php

declare(strict_types = 1);

namespace App\Enums;

enum UserRoles:string
{
    case ADMIN = 'admin';
    case USER = 'user';
}

<?php

declare(strict_types = 1);

namespace App\Repositories\Contracts;

use App\Models\Blog;

interface BlogRepositoryInterface
{
    public function save(Blog $blog): void;
}

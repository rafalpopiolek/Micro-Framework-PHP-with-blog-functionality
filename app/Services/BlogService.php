<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\Contracts\BlogRepositoryInterface;

readonly class BlogService
{
    public function __construct(private BlogRepositoryInterface $blogRepository)
    {
    }

    public function canDelete(int $blogId): bool
    {
        if (! $this->blogRepository->isAuthor($blogId) && ! isAdmin()) {
            return false;
        }

        return true;
    }
}

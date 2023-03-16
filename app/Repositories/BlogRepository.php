<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\DatabaseConnection;
use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryInterface;

readonly class BlogRepository implements BlogRepositoryInterface
{
    public function __construct(private DatabaseConnection $databaseConnection)
    {
    }

    public function save(Blog $blog): void
    {
        $text = $blog->getText();
        $userId = $blog->getUserId();

        $this->databaseConnection->query(
            "INSERT INTO blog(text, userid) VALUES('$text', '$userId');"
        );
    }
}

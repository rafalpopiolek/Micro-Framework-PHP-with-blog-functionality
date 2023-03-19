<?php

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Request;
use App\Validators\BlogValidator;

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

    public function validate(Request $request): BlogValidator
    {
        return new BlogValidator(
            data: [
                'text' => $request->postParam('text'),
            ],
            validationFields: [
                'text' => [
                    'required' => true,
                    'min' => 6,
                    'max' => 2000,
                ]
            ]
        );
    }
}

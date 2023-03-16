<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Request;
use App\View;

class BlogController
{
    public function __construct(private readonly BlogRepositoryInterface $blogRepository)
    {
    }

    public function index(): View
    {
        $blogs = $this->blogRepository->getAll();

        return View::make('blog/index', [
            'data' => $blogs,
        ]);
    }

    public function create(): View
    {
        return View::make('blog/create');
    }

    public function store(Request $request): View
    {
        if ($this->blogRepository->create(
            $request->postParam('text')
        )) {
            return View::make('blog/index');
        }

        return View::make('blog/index');
    }
}

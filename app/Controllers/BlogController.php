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
            'blogs' => $blogs,
        ]);
    }

    public function load(Request $request): void
    {
        $params = $request->getQueryParameters();

        $blogs = $this->blogRepository->getPaginated(
            start: (int)$params['start'],
            length: (int)$params['length'],
            search: $params['search']['value'],
            orderBy: $params['columns'][$params['order'][0]['column']]['data'],
            orderDir: $params['order'][0]['dir'],
        );

        $totalBlogs = $this->blogRepository->count();

        echo json_encode([
            'data' => $blogs,
            'draw' => (int)$request->getParam('draw'),
            'recordsTotal' => $totalBlogs,
            'recordsFiltered' => $totalBlogs,
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

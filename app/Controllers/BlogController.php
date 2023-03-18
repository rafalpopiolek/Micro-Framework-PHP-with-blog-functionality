<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Request;
use App\Services\DataTableService;
use App\View;

readonly class BlogController
{
    public function __construct(
        private BlogRepositoryInterface $blogRepository,
        private DataTableService $dataTableService,
    ) {
    }

    public function index(): View
    {
        return View::make('blog/index');
    }

    /**
     * This function returns data that are required for datatable
     */
    public function load(Request $request): void
    {
        $params = $this->dataTableService->getQueryParameters($request);

        $blogs = $this->blogRepository->getPaginated($params);

        $totalBlogs = $this->blogRepository->count();

        echo json_encode([
            'data' => $blogs,
            'draw' => $params->draw,
            'recordsTotal' => $totalBlogs,
            'recordsFiltered' => $totalBlogs,
        ]);
    }

    public function create(): View
    {
        return View::make('blog/create');
    }

    public function store(Request $request): void
    {
        $this->blogRepository->create($request->postParam('text'));

        $_SESSION['message'] = "Blog created successfully";
        redirect_to('/blog', 200);
    }

    public function destroy(Request $request): void
    {
        if ($this->blogRepository->delete(
            (int)$request->getJson()['id']
        )
        ) {
            $response = [
                'status' => 200,
            ];
        } else {
            $response = [
                'status' => 409,
            ];
        }

        echo json_encode($response);
    }
}

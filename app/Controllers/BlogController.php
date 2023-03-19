<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Contracts\SessionInterface;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Request;
use App\Services\BlogService;
use App\Services\DataTableService;
use App\View;

readonly class BlogController
{
    public function __construct(
        private BlogRepositoryInterface $blogRepository,
        private SessionInterface $session,
        private DataTableService $dataTableService,
        private BlogService $blogService,
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
        if (! isAuth()) {
            redirect_to('/blog', 401);
        }

        return View::make('blog/create');
    }

    public function store(Request $request): void
    {
        if (! isAuth()) {
            redirect_to('/blog', 401);
        }

        $validator = $this->blogService->validate($request);

        if ($validator->fails()) {
            $this->session->put('errors', $validator->getErrors());

            redirect_to('/blog/?action=create', 403);
        }

        $data = $validator->getValidated();

        $this->blogRepository->create($data['text']);

        $this->session->put('message', 'Blog created successfully');

        redirect_to('/blog', 200);
    }

    public function destroy(Request $request): void
    {
        $blogId = (int)$request->getJson()['id'];

        if (! $this->blogService->canDelete($blogId)) {
            echo json_encode([
                'status' => 401
            ]);
            exit;
        }

        $response = $this->blogRepository->delete($blogId) ? ['status' => 200] : ['status' => 409];

        echo json_encode($response);
    }
}

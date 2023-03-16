<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\View;

class BlogController
{
    public function index(): View
    {
        return View::make("blog/index", ['data' => 'asdasdasd']);
    }
}

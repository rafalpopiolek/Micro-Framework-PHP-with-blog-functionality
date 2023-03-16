<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $params = [],
    ) {
        $this->render();
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    /**
     * @throws ViewNotFoundException
     */
    public function render(): string
    {
        $viewPath = VIEW_PATH . $this->view . '.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        /**
         * Check if view is from auth catalog
         * if yes - load auth-layout
         * if not - load base-layout
         *
         * use output buffering to return as string
         */
        $fileCatalog = explode('/', $this->view)[0];

        ob_start();
        if ($fileCatalog === 'auth') {
            include_once VIEW_PATH . '/layouts/auth-layout.php';
        } else {
            include_once VIEW_PATH . '/layouts/base-layout.php';
        }

        return (string)ob_get_flush();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}

<?php

declare(strict_types = 1);

namespace App;

use App\Contracts\SessionInterface;
use App\Exceptions\DIContainerException;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\SessionException;
use App\Exceptions\ViewNotFoundException;
use Exception;
use PDOException;

final readonly class Application
{
    public function __construct(
        private Router $router,
        private Config $config,
        private SessionInterface $session,
        private array $request,

    ) {
        $this->session->start();
        defineRoutes($this->router);
    }

    /**
     *  This method accept routes from routes/web.php
     *  then we resolve the route and catch any exceptions
     */
    public function init(): void
    {
        try {
            $this->router->resolve(
                requestUri: $this->request['uri'],
                requestMethod: $this->request['method']
            );
        } catch (RouteNotFoundException|ViewNotFoundException|DIContainerException $e) {
            if (isDevelopment($this->config->app['environment'])) {
                dd($e);
            }
            showErrorPage('/errors/404.php', 404);
        } catch (SessionException|PDOException|Exception $e) {
            if (isDevelopment($this->config->app['environment'])) {
                dd($e);
            }
            showErrorPage('/errors/server-error.php', 503);
        }
    }
}

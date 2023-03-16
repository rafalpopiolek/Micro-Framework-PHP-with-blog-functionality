<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\DIContainerException;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\ViewNotFoundException;
use Exception;
use PDOException;

final readonly class Application
{
    public function __construct(
        private Router $router,
        private Config $config,
        private array $request,
    ) {
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
        } catch (RouteNotFoundException $e) {
            if (isDevelopment($this->config->app['environment'])) {
                dd($e->getMessage());
            }

            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            die();
        } catch (ViewNotFoundException $e) {
            if (isDevelopment($this->config->app['environment'])) {
                dd($e);
            }

            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            die();
        } catch (DIContainerException $e) {
            if (isDevelopment($this->config->app['environment'])) {
                dd($e);
            }
            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            die();
        } catch (PDOException|Exception $e) {
            if (isDevelopment($this->config->app['environment'])) {
                dd($e);
            }

            http_response_code(503);
            require VIEW_PATH . '/errors/server-error.php';
            die();
        }
    }
}

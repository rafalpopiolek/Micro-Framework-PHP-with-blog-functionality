<?php

declare(strict_types = 1);

namespace App;

use App\Enums\RequestMethod;
use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function register(RequestMethod $reqMethod, string $route, callable|array $action): self
    {
        $this->routes[$reqMethod->value][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::GET, $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::POST, $route, $action);
    }

    public function put(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::PUT, $route, $action);
    }

    public function patch(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::PATCH, $route, $action);
    }

    public function delete(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::DELETE, $route, $action);
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $requestMethod = strtoupper($requestMethod);

        $route = explode('?', $requestUri)[0];
        $getAction = $_GET['action'] ?? null;

        if (! $getAction) {
            $action = $this->routes[$requestMethod][$route] ?? null;
        } else {
            $path = $route . '?action=' . $getAction;
            $action = $this->routes[$requestMethod][$path] ?? null;
        }

        if (! $action) {
            throw new RouteNotFoundException("Route Not Found | 404");
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = new $class();

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], [$_REQUEST]);
                }
            }
        }

        throw new RouteNotFoundException("Route Not Found | 404");
    }
}

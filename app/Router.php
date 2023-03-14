<?php

declare(strict_types = 1);

namespace App;

use App\Enums\RequestMethod;
use App\Exceptions\RouteNotFoundException;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use ReflectionException;
use ReflectionMethod;

class Router
{
    public function __construct(
        private readonly Container $container,
    ) {
    }

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
     * @throws DependencyException
     * @throws NotFoundException
     * @throws RouteNotFoundException
     * @throws ReflectionException
     */
    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $requestMethod = strtoupper($requestMethod);

        $route = explode('?', $requestUri)[0];
        $getAction = $_GET['action'] ?? null;

        if ($getAction) {
            $route = $route . '?action=' . $getAction;
        }

        $action = $this->routes[$requestMethod][$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException("Route Not Found | 404");
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
//                $class = new $class();
                $class = $this->container->get($class);

                if (method_exists($class, $method)) {
                    $reflectionMethod = new ReflectionMethod($class, $method);

                    $parameters = $reflectionMethod->getParameters();

                    $dependencies = $this->getMethodDependencies($parameters);

                    return $reflectionMethod->invokeArgs($class, $dependencies);
                }
            }
        }

        throw new RouteNotFoundException("Route Not Found | 404");
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function getMethodDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getType()->getName();

            if ($dependency) {
                $dependencies[] = $this->container->get($dependency);
            } elseif ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                throw new NotFoundException("Dependency not found for parameter: " . $parameter->getName());
            }
        }
        return $dependencies;
    }
}

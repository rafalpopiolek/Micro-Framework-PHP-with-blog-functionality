<?php

declare(strict_types = 1);

namespace App;

use App\Enums\RequestMethod;
use App\Exceptions\DIContainerException;
use App\Exceptions\RouteNotFoundException;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use ReflectionException;
use ReflectionFunction;
use ReflectionMethod;

class Router
{
    private array $routes = [];

    public function __construct(
        private readonly Container $container,
        private readonly Request $request,
    ) {
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::POST, $route, $action);
    }

    public function register(RequestMethod $reqMethod, string $route, callable|array $action): self
    {
        $this->routes[$reqMethod->value][$route] = $action;

        return $this;
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
     * @throws ReflectionException
     * @throws DIContainerException
     */
    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $action = $this->getAction($requestMethod, $requestUri);

        if (is_callable($action)) {
            // Try to call this method and inject dependencies
            $reflectionFunction = new ReflectionFunction($action);

            // Get function parameters using Reflection
            $parameters = $reflectionFunction->getParameters();

            try {
                $dependencies = $this->getDependencies($parameters);
            } catch (DependencyException|NotFoundException $e) {
                throw new DIContainerException($e->getMessage());
            }

            return $reflectionFunction->invokeArgs($dependencies);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            // Try to initialize a class using container
            try {
                $class = $this->container->get($class);
            } catch (DependencyException|NotFoundException) {
                throw new RouteNotFoundException("Class `$class` Not Found");
            }

            if (method_exists($class, $method)) {
                // Use reflection to get method parameters
                $reflectionMethod = new ReflectionMethod($class, $method);

                $parameters = $reflectionMethod->getParameters();

                try {
                    $dependencies = $this->getDependencies($parameters);
                } catch (DependencyException|NotFoundException $e) {
                    throw new DIContainerException($e->getMessage());
                }

                // Call this method and pass in all necessary dependencies
                return $reflectionMethod->invokeArgs($class, $dependencies);
            }
        }

        throw new RouteNotFoundException();
    }

    /**
     * @param string $requestMethod
     * @param string $requestUri
     * @return mixed
     * @throws RouteNotFoundException
     */
    public function getAction(string $requestMethod, string $requestUri): mixed
    {
        $requestMethod = strtoupper($requestMethod);

        // Get first part of request uri without any GET param
        $route = explode('?', $requestUri)[0];
        // Get `action` query param
        $getAction = $this->request->getParam('action');

        if ($getAction) {
            $route = $route . '?action=' . $getAction;
        }

        $action = $this->routes[$requestMethod][$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        }

        return $action;
    }

    /**
     * Accept all method parameters
     * Try to get dependencies from container
     *
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function getDependencies(array $parameters): array
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

    public function get(string $route, callable|array $action): self
    {
        return $this->register(RequestMethod::GET, $route, $action);
    }
}

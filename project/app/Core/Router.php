<?php

namespace App\Core;

class Router
{
    /** @var array */
    private array $routes = [];

    /**
     * @param string $path
     * @param array $handler
     *
     * @return void
     */
    public function get(
        string $path,
        array $handler
    ): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     *
     * @return void
     */
    public function post(
        string $path,
        array $handler
    ): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $handler
     *
     * @return void
     */
    private function addRoute(
        string $method,
        string $path,
        array $handler
    ): void
    {
        $this->routes[$method][$path] = $handler;
    }

    /**
     * @return void
     */
    public function resolve(): void
    {
        $request = new Request();

        $method = $request->method();
        $path = $request->uri();

        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            (new Response())->abort();
        }

        [$controller, $action] = $handler;

        $instance = new $controller();

        $instance->$action();
    }
}
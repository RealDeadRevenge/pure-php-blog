<?php

namespace App\Core;

class App
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

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
        $this->router->get(
            $path,
            $handler
        );
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
        $this->router->post(
            $path,
            $handler
        );
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->router->resolve();
    }
}
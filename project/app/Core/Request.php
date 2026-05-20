<?php

namespace App\Core;

class Request
{
    /**
     * @return string
     */
    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';

        return strtok($uri, '?');
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function input(
        string $key,
        mixed $default = null
    ): mixed
    {
        return $_REQUEST[$key] ?? $default;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $_REQUEST;
    }
}
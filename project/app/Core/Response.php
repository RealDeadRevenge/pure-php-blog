<?php

namespace App\Core;

class Response
{
    /**
     * @param array $data
     * @param int $statusCode
     *
     * @return void
     */
    public function json(
        array $data,
        int $statusCode = 200
    ): void
    {
        http_response_code($statusCode);

        header('Content-Type: application/json');

        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        exit;
    }

    /**
     * @param string $url
     *
     * @return void
     */
    public function redirect(string $url): void
    {
        header(sprintf('Location: %s', $url));

        exit;
    }

    /**
     * @param int $statusCode
     *
     * @return void
     */
    public function abort(int $statusCode = 404): void
    {
        http_response_code($statusCode);

        echo sprintf('%s Error', $statusCode);

        exit;
    }
}
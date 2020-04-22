<?php

declare(strict_types=1);

namespace App\Controller;

use Slim\Container;
use Slim\Http\Response;

abstract class BaseController
{
    /**
     * @var Container
     */
    protected $container;

    protected function jsonResponse(
        Response $response,
        string $status,
        $message,
        int $code
    ): Response {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

    protected static function isRedisEnabled(): bool
    {
        return filter_var(getenv('REDIS_ENABLED'), FILTER_VALIDATE_BOOLEAN);
    }
}

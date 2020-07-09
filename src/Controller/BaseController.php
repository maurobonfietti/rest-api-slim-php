<?php

declare(strict_types=1);

namespace App\Controller;

use Slim\Container;
use Slim\Http\Response;

abstract class BaseController
{
    protected $container;

    protected const DEFAULT_PER_PAGE_PAGINATION = 5;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

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

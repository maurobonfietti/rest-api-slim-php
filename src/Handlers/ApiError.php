<?php

namespace App\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ApiError extends \Slim\Handlers\Error
{
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $statusCode = $exception->getCode() ?: 500;
        if ($statusCode > 512) {
            $statusCode = 500;
        }
        $data = [
            'code' => $exception->getCode(),
            'status' => 'error',
            'message' => $exception->getMessage(),
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return $response
                    ->withStatus($statusCode)
                    ->withHeader("Content-type", "application/json")
                    ->write($body);
    }
}

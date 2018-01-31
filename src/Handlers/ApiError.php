<?php

namespace App\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ApiError extends \Slim\Handlers\Error
{
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $status = $exception->getCode() ?: 500;
        $data = [
            "status" => "error",
            "message" => $exception->getMessage(),
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        return $response
                    ->withStatus($status)
                    ->withHeader("Content-type", "application/json")
                    ->write($body);
    }
}

<?php declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ApiError extends \Slim\Handlers\Error
{
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $statusCode = $exception->getCode() <= 599 ? $exception->getCode() : 500;
        $className = new \ReflectionClass(get_class($exception));
        $data = [
            'message' => $exception->getMessage(),
            'class' => $className->getShortName(),
            'status' => 'error',
            'code' => $statusCode,
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return $response->withStatus($statusCode)->withHeader("Content-type", "application/json")->write($body);
    }
}

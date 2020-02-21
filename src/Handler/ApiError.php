<?php declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ApiError extends \Slim\Handlers\Error
{
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        $statusCode = 500;
        if (is_int($exception->getCode()) && $exception->getCode() >= 400 && $exception->getCode() <= 599) {
            $statusCode = $exception->getCode();
        }
        $className = new \ReflectionClass(get_class($exception));
        $data = [
            'message' => $exception->getMessage(),
            'class' => $className->getShortName(),
            'status' => 'error',
            'code' => $statusCode,
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        return $response
                ->withStatus($statusCode)
                ->withHeader('Content-type', 'application/problem+json')
                ->write($body);
    }
}

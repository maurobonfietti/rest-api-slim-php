<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\AuthException;
use Firebase\JWT\JWT;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class Auth
{
    const FORBIDDEN_MESSAGE_EXCEPTION = 'error: Forbidden, not authorized.';

    public function __invoke(Request $request, Response $response, $next): ResponseInterface
    {
        $jwtHeader = $request->getHeaderLine('Authorization');
        if (empty($jwtHeader) === true) {
            throw new AuthException('JWT Token required.', 400);
        }
        $jwt = explode('Bearer ', $jwtHeader);
        if (!isset($jwt[1])) {
            throw new AuthException('JWT Token invalid.', 400);
        }
        $decoded = $this->checkToken($jwt[1]);
        $object = $request->getParsedBody();
        $object['decoded'] = $decoded;

        return $next($request->withParsedBody($object), $response);
    }

    public function checkToken(string $token)
    {
        try {
            $decoded = JWT::decode($token, getenv('SECRET_KEY'), ['HS256']);
            if (is_object($decoded) && isset($decoded->sub)) {
                return $decoded;
            }
            throw new AuthException(self::FORBIDDEN_MESSAGE_EXCEPTION, 403);
        } catch (\UnexpectedValueException $e) {
            throw new AuthException(self::FORBIDDEN_MESSAGE_EXCEPTION, 403);
        } catch (\DomainException $e) {
            throw new AuthException(self::FORBIDDEN_MESSAGE_EXCEPTION, 403);
        }
    }
}

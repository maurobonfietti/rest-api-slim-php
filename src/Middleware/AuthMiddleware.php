<?php

namespace App\Middleware;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Exception\NoteException;
use \Firebase\JWT\JWT;

class AuthMiddleware
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response PSR7 response
     * @param callable $next Next middleware
     * @throws TokenRequiredException
     * @return ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $jwtHeader = $request->getHeaderLine('Authorization');
        $jwt = explode('Bearer ', $jwtHeader)[1];
        if (empty($jwt) === true) {
            throw new \App\Exception\AuthException('JWT Token required.', 400);
        }
        $decoded = $this->checkToken($jwt);
        $object = $request->getParsedBody();
        $object['decoded'] = $decoded;

        return $next($request->withParsedBody($object), $response);
    }

    public function checkToken($token)
    {
        $auth = false;

        try {
            $decoded = JWT::decode($token, getenv('SECRET_KEY'), ['HS256']);
        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $e) {
            $auth = false;
        }

        if (isset($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true;
        }

        if ($auth === false) {
            throw new \App\Exception\AuthException('error: Forbidden, not authorized.', 403);
        }

        return $decoded;
    }
}

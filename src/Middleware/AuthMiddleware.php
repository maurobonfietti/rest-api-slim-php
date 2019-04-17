<?php

namespace App\Middleware;

use App\Exception\AuthException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
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
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return ResponseInterface
     * @throws AuthException
     */
    public function __invoke($request, $response, $next)
    {
        $jwtHeader = $request->getHeaderLine('Authorization');
        $jwt = explode('Bearer ', $jwtHeader)[1];
        if (empty($jwt) === true) {
            throw new AuthException('JWT Token required.', 400);
        }
        $decoded = $this->checkToken($jwt);
        $object = $request->getParsedBody();
        $object['decoded'] = $decoded;

        return $next($request->withParsedBody($object), $response);
    }

    /**
     * @param string $token
     * @return object
     * @throws AuthException
     */
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
            throw new AuthException('error: Forbidden, not authorized.', 403);
        }

        return $decoded;
    }
}

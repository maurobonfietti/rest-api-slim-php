<?php declare(strict_types=1);

namespace App\Middleware;

use App\Exception\AuthException;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

class AuthMiddleware
{
    /**
     * @param Request $request
     * @param Response $response
     * @param Callable $next
     * @return ResponseInterface
     * @throws AuthException
     */
    public function __invoke(Request $request, Response $response, $next): ResponseInterface
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
     * @return mixed
     * @throws AuthException
     */
    public function checkToken(string $token)
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

<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;

abstract class Base
{
    private const FORBIDDEN_MESSAGE = 'Forbidden: you are not authorized.';

    protected function checkToken(string $token): object
    {
        try {
            $decoded = JWT::decode($token, getenv('SECRET_KEY'), ['HS256']);
            if (is_object($decoded) && isset($decoded->sub)) {
                return $decoded;
            }
            throw new Auth(self::FORBIDDEN_MESSAGE, 403);
        } catch (\UnexpectedValueException $exception) {
            throw new Auth(self::FORBIDDEN_MESSAGE, 403);
        } catch (\DomainException $exception) {
            throw new Auth(self::FORBIDDEN_MESSAGE, 403);
        }
    }
}

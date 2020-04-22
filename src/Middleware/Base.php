<?php

declare(strict_types=1);

namespace App\Middleware;

use Firebase\JWT\JWT;

abstract class Base
{
    private const FORBIDDEN_MESSAGE_EXCEPTION = 'error: Forbidden, not authorized.';

    protected function checkToken(string $token)
    {
        try {
            $decoded = JWT::decode($token, getenv('SECRET_KEY'), ['HS256']);
            if (is_object($decoded) && isset($decoded->sub)) {
                return $decoded;
            }
            throw new \App\Exception\Auth(self::FORBIDDEN_MESSAGE_EXCEPTION, 403);
        } catch (\UnexpectedValueException $e) {
            throw new \App\Exception\Auth(self::FORBIDDEN_MESSAGE_EXCEPTION, 403);
        } catch (\DomainException $e) {
            throw new \App\Exception\Auth(self::FORBIDDEN_MESSAGE_EXCEPTION, 403);
        }
    }
}

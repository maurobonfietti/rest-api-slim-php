<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

abstract class Base
{
    /** HS256 requires a secret key of at least 256 bits (32 bytes). */
    private const SECRET_KEY_MIN_LENGTH = 32;

    protected function checkToken(string $token): object
    {
        $secretKey = (string) $_SERVER['SECRET_KEY'];
        if (strlen($secretKey) < self::SECRET_KEY_MIN_LENGTH) {
            throw new Auth('Server error: invalid JWT configuration.', 500);
        }
        try {
            return JWT::decode($token, new Key($secretKey, 'HS256'));
        } catch (\UnexpectedValueException | \DomainException) {
            throw new Auth('Forbidden: you are not authorized.', 403);
        }
    }
}

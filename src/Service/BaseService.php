<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Task;
use App\Exception\User;
use Respect\Validation\Validator as v;

abstract class BaseService
{
    protected static function isRedisEnabled(): bool
    {
        return filter_var(getenv('REDIS_ENABLED'), FILTER_VALIDATE_BOOLEAN);
    }

    protected static function validateUserName(string $name): string
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new User('Invalid name.', 400);
        }

        return $name;
    }

    protected static function validateEmail(string $emailValue): string
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (!v::email()->validate($email)) {
            throw new User('Invalid email', 400);
        }

        return $email;
    }

    protected static function validateTaskName(string $name): string
    {
        if (!v::length(2, 100)->validate($name)) {
            throw new Task('Invalid name.', 400);
        }

        return $name;
    }

    protected static function validateTaskStatus(int $status): int
    {
        if (!v::numeric()->between(0, 1)->validate($status)) {
            throw new Task('Invalid status', 400);
        }

        return $status;
    }
}

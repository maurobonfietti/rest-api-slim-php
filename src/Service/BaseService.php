<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\TaskException;
use App\Exception\UserException;
use App\Exception\NoteException;
use Respect\Validation\Validator as v;

abstract class BaseService
{
    protected static function validateUserName(string $name): string
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new UserException('Invalid name.', 400);
        }

        return $name;
    }

    protected static function validateEmail(string $emailValue): string
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (!v::email()->validate($email)) {
            throw new UserException('Invalid email', 400);
        }

        return $email;
    }

    protected static function validateTaskName(string $name): string
    {
        if (!v::length(2, 100)->validate($name)) {
            throw new TaskException('Invalid name.', 400);
        }

        return $name;
    }

    protected static function validateTaskStatus(int $status): int
    {
        if (!v::numeric()->between(0, 1)->validate($status)) {
            throw new TaskException('Invalid status', 400);
        }

        return $status;
    }

    protected static function validateNoteName(string $name): string
    {
        if (!v::length(2, 50)->validate($name)) {
            throw new NoteException('The name of the note is invalid.', 400);
        }

        return $name;
    }
}

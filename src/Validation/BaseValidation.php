<?php

namespace App\Validation;

//use App\Message\UserMessage;
use App\Exception\TaskException;
use App\Exception\UserException;
use Respect\Validation\Validator as v;

/**
 * Base Validation.
 */
abstract class BaseValidation
{
    /**
     * Validate and sanitize a username.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected static function validateName($name)
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new UserException(UserException::USER_NAME_INVALID, 400);
        }

        return $name;
    }

    /**
     * Validate and sanitize a email address.
     *
     * @param string $emailValue
     * @return string
     * @throws \Exception
     */
    protected static function validateEmail($emailValue)
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (!v::email()->validate($email)) {
            throw new UserException(UserException::USER_EMAIL_INVALID, 400);
        }

        return $email;
    }

    /**
     * Validate and sanitize a task name.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected static function validateTaskName($name)
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new TaskException(TaskException::TASK_NAME_INVALID, 400);
        }

        return $name;
    }

    /**
     * Validate and sanitize a task status.
     *
     * @param int $status
     * @return string
     * @throws \Exception
     */
    protected static function validateStatus($status)
    {
        if (!v::numeric()->between(0, 1)->validate($status)) {
            throw new TaskException(TaskException::TASK_STATUS_INVALID, 400);
        }

        return $status;
    }
}

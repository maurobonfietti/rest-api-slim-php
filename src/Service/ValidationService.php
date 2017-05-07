<?php

namespace App\Service;

use App\Message\TaskMessage;
use App\Message\UserMessage;
use Respect\Validation\Validator as v;

/**
 * Validation Service.
 */
abstract class ValidationService
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
            throw new \Exception(UserMessage::USER_NAME_INVALID, 400);
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
            throw new \Exception(UserMessage::USER_EMAIL_INVALID, 400);
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
            throw new \Exception(TaskMessage::TASK_NAME_INVALID, 400);
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
            throw new \Exception(TaskMessage::TASK_STATUS_INVALID, 400);
        }

        return $status;
    }

    /**
     * Validate and sanitize input data when create new user.
     *
     * @param array $input
     * @return string
     * @throws \Exception
     */
    public static function validateInputOnCreateUser($input)
    {
        if (!isset($input['name'])) {
            throw new \Exception(UserMessage::USER_NAME_REQUIRED, 400);
        }
        $name = self::validateName($input['name']);
        $email = null;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }

    /**
     * Validate and sanitize input data when update a user.
     *
     * @param array $input
     * @param object $user
     * @return string
     * @throws \Exception
     */
    public static function validateInputOnUpdateUser($input, $user)
    {
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new \Exception(UserMessage::USER_INFO_REQUIRED, 400);
        }
        $name = $user->name;
        if (isset($input['name'])) {
            $name = self::validateName($input['name']);
        }
        $email = $user->email;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }

    /**
     * Validate and sanitize input data when create new task.
     *
     * @param array $input
     * @return string
     * @throws \Exception
     */
    public static function validateInputOnCreateTask($input)
    {
        if (empty($input['task'])) {
            throw new \Exception(TaskMessage::TASK_NAME_REQUIRED, 400);
        }
        $task = self::validateTaskName($input['task']);
        $status = 0;
        if (isset($input['status'])) {
            $status = self::validateStatus($input['status']);
        }

        return ['task' => $task, 'status' => $status];
    }

    /**
     * Validate and sanitize input data when update a task.
     *
     * @param array $input
     * @param array $task
     * @return string
     * @throws \Exception
     */
    public static function validateInputOnUpdateTask($input, $task)
    {
        if (!isset($input['task']) && !isset($input['status'])) {
            throw new \Exception(TaskMessage::TASK_INFO_REQUIRED, 400);
        }
        $name = $task->task;
        if (isset($input['task'])) {
            $name = self::validateTaskName($input['task']);
        }
        $status = $task->status;
        if (isset($input['status'])) {
            $status = self::validateStatus($input['status']);
        }

        return ['task' => $name, 'status' => $status];
    }
}

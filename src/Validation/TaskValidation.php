<?php

namespace App\Validation;

use App\Message\TaskMessage;
use Respect\Validation\Validator as v;

/**
 * Task Validation.
 */
abstract class TaskValidation
{
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

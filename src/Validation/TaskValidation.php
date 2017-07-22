<?php

namespace App\Validation;

use App\Exception\TaskException;

/**
 * Task Validation.
 */
abstract class TaskValidation extends BaseValidation
{
    /**
     * Validate and sanitize input data when create new task.
     *
     * @param array|object|null $input
     * @return array
     * @throws \Exception
     */
    public static function validateInputOnCreateTask($input)
    {
        if (empty($input['name'])) {
            throw new TaskException(TaskException::TASK_NAME_REQUIRED, 400);
        }
        $task = self::validateTaskName($input['name']);
        $status = 0;
        if (isset($input['status'])) {
            $status = self::validateStatus($input['status']);
        }

        return ['name' => $task, 'status' => $status];
    }

    /**
     * Validate and sanitize input data when update a task.
     *
     * @param array|object|null $input
     * @param object $task
     * @return array
     * @throws \Exception
     */
    public static function validateInputOnUpdateTask($input, $task)
    {
        if (!isset($input['name']) && !isset($input['status'])) {
            throw new TaskException(TaskException::TASK_INFO_REQUIRED, 400);
        }
        $name = $task->name;
        if (isset($input['name'])) {
            $name = self::validateTaskName($input['name']);
        }
        $status = $task->status;
        if (isset($input['status'])) {
            $status = self::validateStatus($input['status']);
        }

        return ['name' => $name, 'status' => $status];
    }
}

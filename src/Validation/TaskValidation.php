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
     * @param array $input
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
     * @param array $input
     * @param object $task
     * @return string
     */
    public static function validateNameOnUpdateTask($input, $task)
    {
        $name = $task->name;
        if (isset($input['name'])) {
            $name = self::validateTaskName($input['name']);
        }

        return $name;
    }

    /**
     * @param array $input
     * @param object $task
     * @return int
     */
    public static function validateStatusOnUpdateTask($input, $task)
    {
        $status = $task->status;
        if (isset($input['status'])) {
            $status = self::validateStatus($input['status']);
        }

        return $status;
    }
}

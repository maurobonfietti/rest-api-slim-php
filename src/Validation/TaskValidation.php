<?php

namespace App\Validation;

use App\Message\TaskMessage;

/**
 * Task Validation.
 */
abstract class TaskValidation extends BaseValidation
{
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

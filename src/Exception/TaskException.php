<?php

namespace App\Exception;

/**
 * Task Exception.
 */
class TaskException extends BaseException
{
    const TASK_NOT_FOUND = 'Task not found.';
    const TASK_NAME_NOT_FOUND = 'Task not found.';
    const TASK_NAME_REQUIRED = 'Fields required.';
    const TASK_INFO_REQUIRED = 'Enter the data to update the task.';
    const TASK_NAME_INVALID = 'Error in task.';
    const TASK_STATUS_INVALID = 'Error in status.';

    /**
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

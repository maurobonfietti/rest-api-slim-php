<?php

namespace App\Exception;

/**
 * Task Exception.
 */
class TaskException extends BaseException
{
    const TASK_NOT_FOUND = 'Not found.';
    const TASK_NAME_NOT_FOUND = 'Not found.';
    const TASK_NAME_REQUIRED = 'Fields required.';
    const TASK_INFO_REQUIRED = 'Enter the data to update the task.';
    const TASK_NAME_INVALID = 'Error in task.';
    const TASK_STATUS_INVALID = 'Error in status.';
}

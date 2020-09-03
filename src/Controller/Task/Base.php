<?php

declare(strict_types=1);

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Exception\Task;
use App\Service\Task\TaskService;

abstract class Base extends BaseController
{
    protected function getTaskService(): TaskService
    {
        return $this->container->get('task_service');
    }

    protected function getAndValidateUserId(array $input): int
    {
        if (isset($input['decoded']) && isset($input['decoded']->sub)) {
            return (int) $input['decoded']->sub;
        }

        throw new Task('Invalid user. Permission failed.', 400);
    }
}

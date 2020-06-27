<?php

declare(strict_types=1);

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Service\Task\TaskService;

abstract class Base extends BaseController
{
    protected function getTaskService(): TaskService
    {
        return $this->container->get('task_service');
    }
}

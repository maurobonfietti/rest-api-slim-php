<?php declare(strict_types=1);

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Service\TaskService;
use Slim\Container;

abstract class BaseTask extends BaseController
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getTaskService(): TaskService
    {
        return $this->container->get('task_service');
    }
}

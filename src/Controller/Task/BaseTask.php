<?php declare(strict_types=1);

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Service\TaskService;
use Slim\Container;

abstract class BaseTask extends BaseController
{
    /**
     * @var TaskService
     */
    protected $taskService;

    public function __construct(Container $container)
    {
        $this->taskService = $container->get('task_service');
    }

    protected function getTaskService(): TaskService
    {
        return $this->taskService;
    }
}

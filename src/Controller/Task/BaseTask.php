<?php

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Service\TaskService;
use Slim\Container;

/**
 * Base Task Controller.
 */
abstract class BaseTask extends BaseController
{
    /**
     * @var TaskService
     */
    protected $taskService;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->logger = $container->get('logger');
        $this->taskService = $container->get('task_service');
    }

    /**
     * @return TaskService
     */
    protected function getTaskService()
    {
        return $this->taskService;
    }

    /**
     * @return array
     */
    protected function getInput()
    {
        return $this->request->getParsedBody();
    }
}

<?php

namespace App\Controller\Task;

use App\Controller\BaseController;
use App\Service\TaskService;

/**
 * Base Task Controller.
 */
class BaseTask extends BaseController
{
    /**
     * @param \Slim\Container $container
     */
    public function __construct(\Slim\Container $container)
    {
        $this->logger = $container->get('logger');
        $this->database = $container->get('db');
    }

    /**
     * @return TaskService
     */
    protected function getTaskService()
    {
        $service = new TaskService($this->database);

        return $service;
    }
}

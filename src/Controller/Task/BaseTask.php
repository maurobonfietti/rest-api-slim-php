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
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->logger = $container->get('logger');
        $this->database = $container->get('db');
        $this->container = $container;
    }

    /**
     * @return TaskService
     */
    protected function getTaskService()
    {
        $service = new TaskService($this->database);

        return $service;
    }

    /**
     * @return array
     */
    protected function getInput()
    {
        return $this->request->getParsedBody();
    }
}

<?php

namespace App\Controller\Task;

use App\Controller\BaseController;

/**
 * Base Task Controller.
 */
class BaseTaskController extends BaseController
{
    /**
     * @param \Slim\Container $container
     */
    public function __construct(\Slim\Container $container)
    {
        $this->logger = $container->get('logger');
        $this->database = $container->get('db');
    }
}

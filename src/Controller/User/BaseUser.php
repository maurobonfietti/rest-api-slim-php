<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Service\UserService;

/**
 * Base User Controller.
 */
abstract class BaseUser extends BaseController
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
     * @return UserService
     */
    protected function getUserService()
    {
        $service = new UserService($this->database);

        return $service;
    }
}

<?php

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Service\UserService;
use Slim\Container;

/**
 * Base User Controller.
 */
abstract class BaseUser extends BaseController
{
    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->logger = $container->get('logger');
        $this->database = $container->get('db');
        $this->userService = $container->get('user_service');
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return $this->userService;
    }

    /**
     * @return array
     */
    protected function getInput()
    {
        return $this->request->getParsedBody();
    }
}

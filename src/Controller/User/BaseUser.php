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
     * @var UserService
     */
    protected $userService;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $container->get('logger');
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return $this->container->get('user_service');
    }

    /**
     * @return array
     */
    protected function getInput()
    {
        return $this->request->getParsedBody();
    }
}

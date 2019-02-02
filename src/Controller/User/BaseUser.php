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
    const KEY = 'rest-api-slim-php:user:';

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
    }

    /**
     * @return UserService
     */
    protected function getUserService()
    {
        return $this->container->get('user_service');
    }
}

<?php declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Exception\UserException;
use App\Service\UserService;
use Slim\Container;

abstract class BaseUser extends BaseController
{
    const KEY = 'rest-api-slim-php:user:';

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getUserService(): UserService
    {
        return $this->container->get('user_service');
    }

    /**
     * @throws UserException
     */
    protected function checkUserPermissions()
    {
        $input = $this->getInput();
        if ($this->args['id'] != $input['decoded']->sub) {
            throw new UserException('User permission failed.', 400);
        }
    }
}

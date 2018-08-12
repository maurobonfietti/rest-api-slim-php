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

    protected function getRedisClient()
    {
        return $this->container->get('redis');
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function getFromCache($id)
    {
        $redis = $this->getRedisClient();
        $key = 'api-rest-slimphp:user:'.$id;
        $value = $redis->get($key);

        return json_decode($value);
    }

    /**
     * @param int $id
     * @param mixed $result
     */
    protected function saveInCache($id, $result)
    {
        $redis = $this->getRedisClient();
        $key = 'api-rest-slimphp:user:'.$id;
        $redis->set($key, json_encode($result));
    }

    /**
     * @param int $id
     */
    protected function deleteFromCache($id)
    {
        $redis = $this->getRedisClient();
        $key = 'api-rest-slimphp:user:'.$id;
        $redis->del($key);
    }
}

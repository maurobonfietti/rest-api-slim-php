<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Base Controller.
 */
abstract class BaseController
{
    /**
     * @var \Psr\Container\ContainerInterface
     */
    protected $container;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    protected function setParams($request, $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    /**
     * Send response with json as standard format.
     *
     * @param string $status
     * @param mixed $message
     * @param int $code
     * @return Response
     */
    protected function jsonResponse($status, $message, $code)
    {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $this->response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

    /**
     * @return array
     */
    protected function getInput()
    {
        return $this->request->getParsedBody();
    }

    /**
     * @return \Predis\Client
     */
    protected function getRedisClient()
    {
        return $this->container->get('redis');
    }

    /**
     * @return boolean
     */
    protected function useRedis()
    {
        return $this->container->get('settings')['useRedisCache'];
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function getFromCache($id)
    {
        $redis = $this->getRedisClient();
        $key = $this::KEY . $id;
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
        $key = $this::KEY . $id;
        $redis->set($key, json_encode($result));
    }

    /**
     * @param int $id
     */
    protected function deleteFromCache($id)
    {
        $redis = $this->getRedisClient();
        $key = $this::KEY . $id;
        $redis->del($key);
    }
}

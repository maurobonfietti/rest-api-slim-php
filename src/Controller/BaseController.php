<?php declare(strict_types=1);

namespace App\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController
{
    /**
     * @var Container
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

    protected function setParams(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    /**
     * @param string $status
     * @param mixed $message
     * @param int $code
     * @return Response
     */
    protected function jsonResponse(string $status, $message, int $code):  Response
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

    protected function getRedisClient(): \Predis\Client
    {
        return $this->container->get('redis');
    }

    protected function useRedis(): bool
    {
        return $this->container->get('settings')['useRedisCache'];
    }

    /**
     * @param int $id
     * @return mixed
     */
    protected function getFromCache(int $id)
    {
        $redis = $this->getRedisClient();
        $key = $this::KEY . $id;
        $value = $redis->get($key);
        if ($value === null) {
            return null;
        }

        return json_decode($value);
    }

    /**
     * @param int $id
     * @param mixed $result
     */
    protected function saveInCache(int $id, $result)
    {
        $redis = $this->getRedisClient();
        $key = $this::KEY . $id;
        $redis->set($key, json_encode($result));
    }

    /**
     * @param int $id
     */
    protected function deleteFromCache(int $id)
    {
        $redis = $this->getRedisClient();
        $key = $this::KEY . $id;
        $redis->del($key);
    }
}

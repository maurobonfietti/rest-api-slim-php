<?php

namespace App\Controller\Note;

use App\Controller\BaseController;
use App\Service\NoteService;
use Slim\Container;

/**
 * Base Note Controller.
 */
abstract class BaseNote extends BaseController
{
    const KEY = 'rest-api-slim-php:note:';

    /**
     * @var NoteService
     */
    protected $noteService;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $container->get('logger');
    }

    /**
     * @return NoteService
     */
    protected function getNoteService()
    {
        return $this->container->get('note_service');
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
        $key = $this::KEY.$id;
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
        $key = $this::KEY.$id;
        $redis->set($key, json_encode($result));
    }

    /**
     * @param int $id
     */
    protected function deleteFromCache($id)
    {
        $redis = $this->getRedisClient();
        $key = $this::KEY.$id;
        $redis->del($key);
    }
}

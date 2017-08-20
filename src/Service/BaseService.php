<?php

namespace App\Service;

use App\Repository\TaskRepository;

/**
 * Base Service.
 */
abstract class BaseService
{
    protected $database;

    protected $request;

    protected $response;

    protected $args;

    /**
     * @return TaskRepository
     */
    protected function getTaskRepository()
    {
        $repository = new TaskRepository($this->database);

        return $repository;
    }
}

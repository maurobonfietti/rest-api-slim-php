<?php

namespace App\Controller\Task;

use App\Controller\BaseController;

/**
 * Tasks Controller.
 */
class TaskController extends BaseController
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
     * Get one task by id.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getTask($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getTaskService()->getTask($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function searchTasks($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getTaskService()->searchTasks($this->args['query']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create a task.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function createTask($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $input = $this->request->getParsedBody();
            $result = $this->getTaskService()->createTask($input);

            return $this->jsonResponse('success', $result, 201);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update a task.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function updateTask($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $input = $this->request->getParsedBody();
            $result = $this->getTaskService()->updateTask($input, $this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete a task.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function deleteTask($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getTaskService()->deleteTask($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

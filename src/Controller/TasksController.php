<?php

/**
 * Tasks Controller.
 */
class TasksController extends Base
{
    /**
     * Constructor of the class.
     *
     * @param object $container
     */
    public function __construct(Slim\Container $container)
    {
        $this->database = $container->db;
    }

    /**
     * Get all tasks.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getTasks($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $service = new TasksService($this->database);
        $result = $service->getTasks();

        return $this->jsonResponse('success', $result, 200);
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
            $service = new TasksService($this->database);
            $result = $service->getTask($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (Exception $ex) {
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
            $service = new TasksService($this->database);
            $result = $service->searchTasks($this->args['query']);

            return $this->jsonResponse('success', $result, 200);
        } catch (Exception $ex) {
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
            $service = new TasksService($this->database);
            $input = $this->request->getParsedBody();
            $result = $service->createTask($input);

            return $this->jsonResponse('success', $result, 200);
        } catch (Exception $ex) {
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
        $this->setParams($request, $response, $args);
        $input = $this->request->getParsedBody();
        $service = new TasksService($this->database);
        try {
            $result = $service->updateTask($input, $this->args['id']);
            return $this->jsonResponse('success', $result, 200);
        } catch (Exception $ex) {
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
            $service = new TasksService($this->database);
            $result = $service->deleteTask($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

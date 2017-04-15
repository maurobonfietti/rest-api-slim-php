<?php

/**
 * Tasks Controller.
 */
class TasksController extends Base
{
    private $database;

    private $request;

    private $response;

    private $args;

    /**
     * Constructor of the class.
     *
     * @param object $container
     */
    public function __construct(Slim\Container $container)
    {
        $this->database = $container->db;
    }

    public function setParams($request, $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    protected function response2($status, $message, $code)
    {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $this->response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $service = new TasksService($this->database);
        $result = $service->getTasks();

        return $this->response2('success', $result, 200);
    }

    /**
     * Get one task by id.
     *
     * @param int $taskId
     * @return array
     */
    public function getTask($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $service = new TasksService($this->database);
            $result = $service->getTask($args['id']);

            return $this->response2('success', $result, 200);
        } catch (Exception $ex) {
            return $this->response2('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     */
    public function searchTasks($request, $response, $args)
    {
        try {
            $service = new TasksService($this->database);
            $tasks = $service->searchTasks($args['query']);
            $result = self::response('success', $tasks, 200);

            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
        }
    }

    /**
     * Create task.
     *
     * @param mixed $request
     * @return array
     */
    public function createTask($request, $response, $args)
    {
        try {
            $service = new TasksService($this->database);
            $task = $service->createTask($request);
            $result = self::response('success', $task, 200);

            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
        }
    }

    /**
     * Update task.
     *
     * @param mixed $request
     * @param int $taskId
     * @return array
     */
    public function updateTask($request, $response, $args)
    {
        try {
            $service = new TasksService($this->database);
            $task = $service->updateTask($request, $args['id']);
            $result = self::response('success', $task, 200);

            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
        }
    }

    /**
     * Delete task.
     *
     * @param int $taskId
     * @return array
     */
    public function deleteTask($request, $response, $args)
    {
        try {
            $service = new TasksService($this->database);
            $task = $service->deleteTask($args['id']);
            $result = self::response('success', $task, 200);

            return $response->withJson($result, 200, JSON_PRETTY_PRINT);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
        }
    }
}

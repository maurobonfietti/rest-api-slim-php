<?php

/**
 * Tasks Controller.
 */
class TasksController extends Base
{
    private $database;

    /**
     * Constructor of the class.
     *
     * @param object $database
     */
    public function __construct(Slim\Container $asd)
    {
//        $this->database = $database;
        $this->database = $asd->db;
//        var_dump($asd->db);
//        exit;
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks($request, $response, $args)
    {
//        var_dump($this->database);
//        exit;
        $service = new TasksService($this->database);
        $response2 = $service->getTasks();
//        var_dump($response2);
//        exit;

        $asd = self::response('success', $response2, 200);
//        var_dump($asd);
//        return $asd;
        return $response->withJson($asd, 200, JSON_PRETTY_PRINT);
//        exit;
//        return self::response('success', $response, 200);
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
            $service = new TasksService($this->database);
            $response2 = $service->getTask($args['id']);
            $asd = self::response('success', $response2, 200);
            return $response->withJson($asd, 200, JSON_PRETTY_PRINT);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
            return self::response('error', $ex->getMessage(), $ex->getCode());
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
            $response2 = $service->searchTasks($args['query']);
            $asd = self::response('success', $response2, 200);
            return $response->withJson($asd, 200, JSON_PRETTY_PRINT);
            
            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
            return self::response('error', $ex->getMessage(), $ex->getCode());
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
            $response2 = $service->createTask($request);
            $asd = self::response('success', $response2, 200);
            return $response->withJson($asd, 200, JSON_PRETTY_PRINT);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
            return self::response('error', $ex->getMessage(), $ex->getCode());
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
            $response2 = $service->updateTask($request, $args['id']);
            $asd = self::response('success', $response2, 200);
            return $response->withJson($asd, 200, JSON_PRETTY_PRINT);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
            return self::response('error', $ex->getMessage(), $ex->getCode());
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
            $response2 = $service->deleteTask($args['id']);
            $asd = self::response('success', $response2, 200);
            return $response->withJson($asd, 200, JSON_PRETTY_PRINT);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return $response->withJson(self::response('error', $ex->getMessage(), $ex->getCode()), $ex->getCode(), JSON_PRETTY_PRINT);
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

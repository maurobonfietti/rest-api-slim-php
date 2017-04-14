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
     * @param type $database
     */
    public function __construct($database = null)
    {
        $this->database = $database;
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks()
    {
        $service = new TasksService($this->database);
        $response = $service->getTasks();

        return self::response('success', $response, 200);
    }

    /**
     * Get one task by id.
     *
     * @param mixed $database
     * @param int $taskId
     * @return array
     */
    public static function getTask($database, $taskId)
    {
        try {
            $service = new TasksService($database);
            $response = $service->getTask($taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name.
     *
     * @param mixed $database
     * @param string $tasksName
     * @return array
     */
    public static function searchTasks($database, $tasksName)
    {
        try {
            $service = new TasksService($database);
            $response = $service->searchTasks($tasksName);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create task.
     *
     * @param mixed $database
     * @param mixed $request
     * @return array
     */
    public static function createTask($database, $request)
    {
        try {
            $service = new TasksService($database);
            $response = $service->createTask($request);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update task.
     *
     * @param mixed $database
     * @param mixed $request
     * @param int $taskId
     * @return array
     */
    public static function updateTask($database, $request, $taskId)
    {
        try {
            $service = new TasksService($database);
            $response = $service->updateTask($request, $taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete task.
     *
     * @param mixed $database
     * @param int $taskId
     * @return array
     */
    public static function deleteTask($database, $taskId)
    {
        try {
            $service = new TasksService($database);
            $response = $service->deleteTask($taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

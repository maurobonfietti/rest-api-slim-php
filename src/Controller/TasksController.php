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
    public function __construct(PDO $database)
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
     * @param int $taskId
     * @return array
     */
    public function getTask($taskId)
    {
        try {
            $service = new TasksService($this->database);
            $response = $service->getTask($taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     */
    public function searchTasks($tasksName)
    {
        try {
            $service = new TasksService($this->database);
            $response = $service->searchTasks($tasksName);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create task.
     *
     * @param mixed $request
     * @return array
     */
    public function createTask($request)
    {
        try {
            $service = new TasksService($this->database);
            $response = $service->createTask($request);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
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
    public function updateTask($request, $taskId)
    {
        try {
            $service = new TasksService($this->database);
            $response = $service->updateTask($request, $taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete task.
     *
     * @param int $taskId
     * @return array
     */
    public function deleteTask($taskId)
    {
        try {
            $service = new TasksService($this->database);
            $response = $service->deleteTask($taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

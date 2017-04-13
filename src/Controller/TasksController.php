<?php

/**
 * Tasks Controller.
 */
class TasksController extends Base
{
    /**
     * Get all tasks
     *
     * @param mixed $database
     * @return array
     */
    public static function getTasks($database)
    {
        try {
            $service = new TasksService;
            $response = $service->getTasks($database);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Get one task by id
     *
     * @param mixed $database
     * @param int $taskId
     * @return array
     */
    public static function getTask($database, $taskId)
    {
        try {
            $service = new TasksService;
            $response = $service->getTask($database, $taskId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name
     *
     * @param mixed $database
     * @param string $tasksName
     * @return array
     */
    public static function searchTasks($database, $tasksName)
    {
        $service = new TasksService;

        return $service->searchTasks($database, $tasksName);
    }

    /**
     * Create task
     *
     * @param mixed $database
     * @param mixed $request
     * @return array
     */
    public static function createTask($database, $request)
    {
        $service = new TasksService;

        return $service->createTask($database, $request);
    }

    /**
     * Update task
     *
     * @param mixed $database
     * @param mixed $request
     * @param int $taskId
     * @return array
     */
    public static function updateTask($database, $request, $taskId)
    {
        $service = new TasksService;

        return $service->updateTask($database, $request, $taskId);
    }

    /**
     * Delete task
     *
     * @param mixed $database
     * @param int $taskId
     * @return array
     */
    public static function deleteTask($database, $taskId)
    {
        $service = new TasksService;

        return $service->deleteTask($database, $taskId);
    }
}

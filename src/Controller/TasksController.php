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
        $service = new TasksService;

        return $service->getTasks($database);
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
        $service = new TasksService;

        return $service->getTask($database, $taskId);
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

<?php

namespace App\Service;

use App\Repository\TaskRepository;
use App\Validation\TaskValidation as vs;

/**
 * Tasks Service.
 */
class TaskService extends BaseService
{
    /**
     * @param \PDO $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Check if the task exists.
     *
     * @param int $taskId
     * @return object
     */
    protected function checkTask($taskId)
    {
        $repository = new TaskRepository($this->database);
        $task = $repository->checkTask($taskId);

        return $task;
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks()
    {
        $repository = new TaskRepository($this->database);
        $tasks = $repository->getTasks();

        return $tasks;
    }

    /**
     * Get one task by id.
     *
     * @param int $taskId
     * @return object
     */
    public function getTask($taskId)
    {
        $task = $this->checkTask($taskId);

        return $task;
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     */
    public function searchTasks($tasksName)
    {
        $repository = new TaskRepository($this->database);
        $tasks = $repository->searchTasks($tasksName);

        return $tasks;
    }

    /**
     * Create a task.
     *
     * @param array|object|null $input
     * @return object
     */
    public function createTask($input)
    {
        $repository = new TaskRepository($this->database);
        $data = vs::validateInputOnCreateTask($input);
        $task = $repository->createTask($data);

        return $task;
    }

    /**
     * Update a task.
     *
     * @param array $input
     * @param int $taskId
     * @return object
     */
    public function updateTask($input, $taskId)
    {
        $checkTask = $this->checkTask($taskId);
        $data = vs::validateInputOnUpdateTask($input, $checkTask);
        $repository = new TaskRepository($this->database);
        $task = $repository->updateTask($data, $taskId);

        return $task;
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return string
     */
    public function deleteTask($taskId)
    {
        $this->checkTask($taskId);
        $repository = new TaskRepository($this->database);
        $response = $repository->deleteTask($taskId);

        return $response;
    }
}

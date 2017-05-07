<?php

namespace App\Service;

use App\Service\MessageService;
use App\Service\ValidationService as vs;
use App\Repository\TaskRepository;

/**
 * Tasks Service.
 */
class TaskService extends BaseService
{
    /**
     * @param object $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Check if the task exists.
     *
     * @param int $taskId
     * @return array
     */
    public function checkTask($taskId)
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
     * @return array
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
     * @param array $input
     * @return array
     * @throws \Exception
     */
    public function createTask($input)
    {
        $data = vs::validateInputOnCreateTask($input);
        $repository = new TaskRepository;
        $query = $repository->createTaskQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('task', $data['task']);
        $statement->bindParam('status', $data['status']);
        $statement->execute();
        $task = $this->checkTask($this->database->lastInsertId());

        return $task;
    }

    /**
     * Update a task.
     *
     * @param array $input
     * @param int $taskId
     * @return array
     * @throws \Exception
     */
    public function updateTask($input, $taskId)
    {
        $task = $this->checkTask($taskId);
        $data = vs::validateInputOnUpdateTask($input, $task);
        $repository = new TaskRepository;
        $query = $repository->updateTaskQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('task', $data['task']);
        $statement->bindParam('status', $data['status']);
        $statement->execute();

        return $this->checkTask($taskId);
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return array
     */
    public function deleteTask($taskId)
    {
        $this->checkTask($taskId);
        $repository = new TaskRepository;
        $query = $repository->deleteTaskQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();

        return MessageService::TASK_DELETED;
    }
}

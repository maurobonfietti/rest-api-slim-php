<?php

namespace App\Service;

use App\Service\MessageService;
use App\Service\ValidationService as vs;
use App\Repository\TasksRepository;

/**
 * Tasks Service.
 */
class TasksService extends BaseService
{
    /**
     * Constructor of the class.
     *
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
     * @return object $task
     * @throws \Exception
     */
    public function checkTask($taskId)
    {
        $tasksRepository = new TasksRepository;
        $query = $tasksRepository->getTaskQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (!$task) {
            throw new \Exception(MessageService::TASK_NOT_FOUND, 404);
        }

        return $task;
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks()
    {
        $repository = new TasksRepository;
        $query = $repository->getTasksQuery();
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
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
     * @throws \Exception
     */
    public function searchTasks($tasksName)
    {
        $repository = new TasksRepository;
        $query = $repository->searchTasksQuery();
        $statement = $this->database->prepare($query);
        $query = '%' . $tasksName . '%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $tasks = $statement->fetchAll();
        if (!$tasks) {
            throw new \Exception(MessageService::TASK_NOT_FOUND, 404);
        }

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
        $repository = new TasksRepository;
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
        $repository = new TasksRepository;
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
        $repository = new TasksRepository;
        $query = $repository->deleteTaskQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();

        return MessageService::TASK_DELETED;
    }
}

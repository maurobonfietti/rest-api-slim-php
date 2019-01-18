<?php

namespace App\Repository;

use App\Message\TaskMessage;
use App\Exception\TaskException;
use App\Repository\Query\TaskQuery;

/**
 * Tasks Repository.
 */
class TaskRepository extends BaseRepository
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
     * @param int|string $taskId
     * @return object $task
     * @throws \Exception
     */
    public function checkTask($taskId)
    {
        $statement = $this->getDb()->prepare(TaskQuery::GET_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (empty($task)) {
            throw new TaskException(TaskException::TASK_NOT_FOUND, 404);
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
        $statement = $this->getDb()->prepare(TaskQuery::GET_TASKS_QUERY);
        $statement->execute();

        return $statement->fetchAll();
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
        $statement = $this->getDb()->prepare(TaskQuery::SEARCH_TASKS_QUERY);
        $query = '%' . $tasksName . '%';
        $statement->bindParam('name', $query);
        $statement->execute();
        $tasks = $statement->fetchAll();
        if (!$tasks) {
            throw new TaskException(TaskException::TASK_NAME_NOT_FOUND, 404);
        }

        return $tasks;
    }

    /**
     * Create a task.
     *
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function createTask($data)
    {
        $statement = $this->getDb()->prepare(TaskQuery::CREATE_TASK_QUERY);
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('status', $data['status']);
        $statement->execute();

        return $this->checkTask($this->database->lastInsertId());
    }

    /**
     * Update a task.
     *
     * @param array $data
     * @param int $taskId
     * @return object
     */
    public function updateTask($data, $taskId)
    {
        $statement = $this->getDb()->prepare(TaskQuery::UPDATE_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('status', $data['status']);
        $statement->execute();

        return $this->checkTask($taskId);
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return string
     */
    public function deleteTask($taskId)
    {
        $statement = $this->getDb()->prepare(TaskQuery::DELETE_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->execute();

        return TaskMessage::TASK_DELETED;
    }
}

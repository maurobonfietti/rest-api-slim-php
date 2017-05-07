<?php

namespace App\Repository;

use App\Message\TaskMessage;
use App\Repository\Query\TaskQuery;

/**
 * Tasks Repository.
 */
class TaskRepository extends BaseRepository
{
    /**
     * @param object $database
     */
    public function __construct(\PDO $database = null)
    {
        $this->database = $database;
    }

    /**
     * Check if the task exists.
     *
     * @param int $taskId
     * @return array $task
     * @throws \Exception
     */
    public function checkTask($taskId)
    {
        $statement = $this->database->prepare(TaskQuery::GET_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (empty($task)) {
            throw new \Exception(TaskMessage::TASK_NOT_FOUND, 404);
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
        $statement = $this->database->prepare(TaskQuery::GET_TASKS_QUERY);
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
        $statement = $this->database->prepare(TaskQuery::SEARCH_TASKS_QUERY);
        $query = '%' . $tasksName . '%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $tasks = $statement->fetchAll();
        if (!$tasks) {
            throw new \Exception(TaskMessage::TASK_NOT_FOUND, 404);
        }

        return $tasks;
    }

    /**
     * Create a task.
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function createTask($data)
    {
        $statement = $this->database->prepare(TaskQuery::CREATE_TASK_QUERY);
        $statement->bindParam('task', $data['task']);
        $statement->bindParam('status', $data['status']);
        $statement->execute();
        $task = $this->checkTask($this->database->lastInsertId());

        return $task;
    }

    /**
     * Update a task.
     *
     * @param array $data
     * @param int $taskId
     * @return array
     */
    public function updateTask($data, $taskId)
    {
        $statement = $this->database->prepare(TaskQuery::UPDATE_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('task', $data['task']);
        $statement->bindParam('status', $data['status']);
        $statement->execute();
        $task = $this->checkTask($taskId);

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
        $statement = $this->database->prepare(TaskQuery::DELETE_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->execute();

        return TaskMessage::TASK_DELETED;
    }
}

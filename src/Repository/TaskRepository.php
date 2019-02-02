<?php

namespace App\Repository;

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
    public function checkAndGetTask($taskId)
    {
        $statement = $this->getDb()->prepare(TaskQuery::GET_TASK_QUERY);
        $statement->bindParam('id', $taskId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (empty($task)) {
            throw new TaskException('Task not found.', 404);
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
            throw new TaskException('Task name not found.', 404);
        }

        return $tasks;
    }

    /**
     * Create a task.
     *
     * @param object $task
     * @return object
     */
    public function createTask($task)
    {
        $statement = $this->getDb()->prepare(TaskQuery::CREATE_TASK_QUERY);
        $statement->bindParam('name', $task->name);
        $statement->bindParam('status', $task->status);
        $statement->execute();

        return $this->checkAndGetTask($this->database->lastInsertId());
    }

    /**
     * Update a task.
     *
     * @param object $task
     * @return object
     */
    public function updateTask($task)
    {
        $statement = $this->getDb()->prepare(TaskQuery::UPDATE_TASK_QUERY);
        $statement->bindParam('id', $task->id);
        $statement->bindParam('name', $task->name);
        $statement->bindParam('status', $task->status);
        $statement->execute();

        return $this->checkAndGetTask($task->id);
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

        return 'The task was deleted.';
    }
}

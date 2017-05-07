<?php

namespace App\Repository;

use App\Service\MessageService;

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
        $query = $this->getTaskQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (empty($task)) {
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
        $query = $this->getTasksQuery();
        $statement = $this->database->prepare($query);
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
        $query = $this->searchTasksQuery();
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
     * Get Task Sql Query.
     *
     * @return string
     */
    public function getTaskQuery()
    {
        return 'SELECT * FROM tasks WHERE id=:id';
    }

    public function getTasksQuery()
    {
        return 'SELECT * FROM tasks ORDER BY task';
    }

    public function searchTasksQuery()
    {
        return 'SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task';
    }

    public function createTaskQuery()
    {
        return 'INSERT INTO tasks (task, status) VALUES (:task, :status)';
    }

    public function updateTaskQuery()
    {
        return 'UPDATE tasks SET task=:task, status=:status WHERE id=:id';
    }

    public function deleteTaskQuery()
    {
        return 'DELETE FROM tasks WHERE id=:id';
    }
}

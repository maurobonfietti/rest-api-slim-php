<?php

namespace App\Repository;

use App\Exception\TaskException;

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
        $query = 'SELECT * FROM tasks WHERE id=:id';
        $statement = $this->getDb()->prepare($query);
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
        $query = 'SELECT * FROM tasks ORDER BY id';
        $statement = $this->getDb()->prepare($query);
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
        $query = 'SELECT * FROM tasks WHERE UPPER(name) LIKE :name ORDER BY id';
        $name = '%' . $tasksName . '%';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $name);
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
        $query = 'INSERT INTO tasks (name, status) VALUES (:name, :status)';
        $statement = $this->getDb()->prepare($query);
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
        $query = 'UPDATE tasks SET name=:name, status=:status WHERE id=:id';
        $statement = $this->getDb()->prepare($query);
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
        $query = 'DELETE FROM tasks WHERE id=:id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->execute();

        return 'The task was deleted.';
    }
}

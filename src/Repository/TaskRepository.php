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
     * @return object
     * @throws TaskException
     */
    public function checkAndGetTask($taskId, $input)
    {
        $query = 'SELECT * FROM tasks WHERE id = :id AND userId = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('userId', $input['decoded']->sub);
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
    public function getTasks($input)
    {
        $query = 'SELECT * FROM tasks WHERE userId = :userId ORDER BY id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('userId', $input['decoded']->sub);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     * @throws TaskException
     */
    public function searchTasks($tasksName, $input)
    {
        $query = 'SELECT * FROM tasks WHERE UPPER(name) LIKE :name AND userId = :userId ORDER BY id';
        $name = '%' . $tasksName . '%';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $name);
        $statement->bindParam('userId', $input['decoded']->sub);
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
    public function createTask($task, $input)
    {
        $query = 'INSERT INTO tasks (name, status, userId) VALUES (:name, :status, :userId)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $task->name);
        $statement->bindParam('status', $task->status);
        $statement->bindParam('userId', $task->userId);
        $statement->execute();

        return $this->checkAndGetTask($this->database->lastInsertId(), $input);
    }

    /**
     * Update a task.
     *
     * @param object $task
     * @return object
     */
    public function updateTask($task, $input)
    {
        $query = 'UPDATE tasks SET name=:name, status=:status WHERE id=:id AND userId = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $task->id);
        $statement->bindParam('name', $task->name);
        $statement->bindParam('status', $task->status);
        $statement->bindParam('userId', $input['decoded']->sub);
        $statement->execute();

        return $this->checkAndGetTask($task->id, $input);
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return string
     */
    public function deleteTask($taskId, $input)
    {
        $query = 'DELETE FROM tasks WHERE id = :id AND userId = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('userId', $input['decoded']->sub);
        $statement->execute();

        return 'The task was deleted.';
    }
}

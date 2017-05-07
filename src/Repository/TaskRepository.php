<?php

namespace App\Repository;

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

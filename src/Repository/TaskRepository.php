<?php

namespace App\Repository;

/**
 * Tasks Repository.
 */
class TaskRepository
{
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

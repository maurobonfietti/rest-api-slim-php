<?php

/**
 * Tasks Repository.
 */
class TasksRepository
{
    public static function getTaskQuery()
    {
        return 'SELECT * FROM tasks WHERE id=:id';
    }

    public static function getTasksQuery()
    {
        return 'SELECT * FROM tasks ORDER BY task';
    }

    public static function searchTasksQuery()
    {
        return 'SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task';
    }

    public static function createTaskQuery()
    {
        return 'INSERT INTO tasks (task) VALUES (:task)';
    }

    public static function updateTaskQuery()
    {
        return 'UPDATE tasks SET task=:task, status=:status WHERE id=:id';
    }

    public static function deleteTaskQuery()
    {
        return 'DELETE FROM tasks WHERE id=:id';
    }
}

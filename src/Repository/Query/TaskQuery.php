<?php

namespace App\Repository\Query;

/**
 * Tasks Query.
 */
abstract class TaskQuery
{
    /**
     * Get Task Sql Query.
     *
     * @return string
     */
    public static function getTaskQuery()
    {
        return 'SELECT * FROM tasks WHERE id=:id';
    }

    /**
     * Get Tasks Sql Query.
     *
     * @return string
     */
    public static function getTasksQuery()
    {
        return 'SELECT * FROM tasks ORDER BY id';
    }

    /**
     * Search Tasks Sql Query.
     *
     * @return string
     */
    public static function searchTasksQuery()
    {
        return 'SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task';
    }

    /**
     * Create Task Sql Query.
     *
     * @return string
     */
    public static function createTaskQuery()
    {
        return 'INSERT INTO tasks (task, status) VALUES (:task, :status)';
    }

    /**
     * Update Task Sql Query.
     *
     * @return string
     */
    public static function updateTaskQuery()
    {
        return 'UPDATE tasks SET task=:task, status=:status WHERE id=:id';
    }

    /**
     * Delete Task Sql Query.
     *
     * @return string
     */
    public static function deleteTaskQuery()
    {
        return 'DELETE FROM tasks WHERE id=:id';
    }
}

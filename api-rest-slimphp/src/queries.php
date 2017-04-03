<?php

/**
 * Query Repository.
 */
class queries
{
    /* Users Query Repository */

    public static function getUserQuery()
    {
        return 'SELECT * FROM users WHERE id=:id';
    }

    public static function getUsersQuery()
    {
        return 'SELECT * FROM users ORDER BY id';
    }

    public static function searchUsersQuery()
    {
        return 'SELECT * FROM users WHERE UPPER(name) LIKE :name ORDER BY id';
    }

    public static function createUserQuery()
    {
        return 'INSERT INTO users (name) VALUES (:name)';
    }

    public static function updateUserQuery()
    {
        return 'UPDATE users SET name=:name WHERE id=:id';
    }

    public static function deleteUserQuery()
    {
        return 'DELETE FROM users WHERE id=:id';
    }

    /* Tasks Query Repository */

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

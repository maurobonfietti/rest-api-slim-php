<?php

namespace App\Repository;

/**
 * Users Repository.
 */
class UsersRepository
{
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
        return 'UPDATE users SET name=:name, email=:email WHERE id=:id';
    }

    public static function deleteUserQuery()
    {
        return 'DELETE FROM users WHERE id=:id';
    }
}

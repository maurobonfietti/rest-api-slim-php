<?php

namespace App\Repository;

/**
 * Users Repository.
 */
class UserRepository
{
    public function getUserQuery()
    {
        return 'SELECT * FROM users WHERE id=:id';
    }

    public function getUsersQuery()
    {
        return 'SELECT * FROM users ORDER BY id';
    }

    public function searchUsersQuery()
    {
        return 'SELECT * FROM users WHERE UPPER(name) LIKE :name ORDER BY id';
    }

    public function createUserQuery()
    {
        return 'INSERT INTO users (name, email) VALUES (:name, :email)';
    }

    public function updateUserQuery()
    {
        return 'UPDATE users SET name=:name, email=:email WHERE id=:id';
    }

    public function deleteUserQuery()
    {
        return 'DELETE FROM users WHERE id=:id';
    }
}

<?php

namespace App\Repository;

use App\Exception\UserException;

/**
 * Users Repository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @param \PDO $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Check if the user exists.
     *
     * @param int|string $userId
     * @return object
     * @throws UserException
     */
    public function checkAndGetUser($userId)
    {
        $query = 'SELECT * FROM users WHERE id=:id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty($user)) {
            throw new UserException('User not found.', 404);
        }

        return $user;
    }

    /**
     * Check if an email already exists.
     *
     * @param string $email
     * @throws UserException
     */
    public function checkUserByEmail($email)
    {
        $query = 'SELECT * FROM users WHERE email = :email';
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty(!$user)) {
            throw new UserException('Email already exists.', 400);
        }
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        $query = 'SELECT * FROM users ORDER BY id';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Search users by name.
     *
     * @param string $usersName
     * @return array
     * @throws UserException
     */
    public function searchUsers($usersName)
    {
        $query = 'SELECT * FROM users WHERE UPPER(name) LIKE :name ORDER BY id';
        $name = '%' . $usersName . '%';
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $name);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            throw new UserException('User name not found.', 404);
        }

        return $users;
    }

    /**
     * Login a user.
     *
     * @param string $email
     * @param string $password
     * @return object
     * @throws UserException
     */
    public function login($email, $password)
    {
        $query = 'SELECT * FROM users WHERE email = :email AND password = :password ORDER BY id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->bindParam('password', $password);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty($user)) {
            throw new UserException('Login failed: Email or password incorrect.', 400);
        }

        return $user;
    }

    /**
     * Create a user.
     *
     * @param object $user
     * @return object
     */
    public function createUser($user)
    {
        $query = 'INSERT INTO users (name, email, password) VALUES (:name, :email, :password)';
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $user->name);
        $statement->bindParam('email', $user->email);
        $statement->bindParam('password', $user->password);
        $statement->execute();

        return $this->checkAndGetUser($this->database->lastInsertId());
    }

    /**
     * Update a user.
     *
     * @param object $user
     * @return object
     */
    public function updateUser($user)
    {
        $query = 'UPDATE users SET name=:name, email=:email WHERE id=:id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $user->id);
        $statement->bindParam('name', $user->name);
        $statement->bindParam('email', $user->email);
        $statement->execute();

        return $this->checkAndGetUser($user->id);
    }

    /**
     * Delete a user.
     *
     * @param int $userId
     * @return string
     */
    public function deleteUser($userId)
    {
        $query = 'DELETE FROM users WHERE id=:id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();

        return 'The user was deleted.';
    }
}

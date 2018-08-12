<?php

namespace App\Repository;

use App\Message\UserMessage;
use App\Exception\UserException;
use App\Repository\Query\UserQuery;

/**
 * Users Repository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @param \PDO $database
     */
    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * Check if the user exists.
     *
     * @param int|string $userId
     * @return object $user
     * @throws \Exception
     */
    public function checkUser($userId)
    {
        $statement = $this->database->prepare(UserQuery::GET_USER_QUERY);
        $statement->bindParam('id', $userId);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty($user)) {
            throw new UserException(UserException::USER_NOT_FOUND, 404);
        }

        return $user;
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        $statement = $this->database->prepare(UserQuery::GET_USERS_QUERY);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Search users by name.
     *
     * @param string $usersName
     * @return array
     * @throws \Exception
     */
    public function searchUsers($usersName)
    {
        $statement = $this->database->prepare(UserQuery::SEARCH_USERS_QUERY);
        $query = '%' . $usersName . '%';
        $statement->bindParam('name', $query);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            throw new UserException(UserException::USER_NAME_NOT_FOUND, 404);
        }

        return $users;
    }

    /**
     * Create a user.
     *
     * @param array $data
     * @return object
     * @throws \Exception
     */
    public function createUser($data)
    {
        $statement = $this->database->prepare(UserQuery::CREATE_USER_QUERY);
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('email', $data['email']);
        $statement->execute();
        $user = $this->checkUser($this->database->lastInsertId());

        return $user;
    }

    /**
     * Update a user.
     *
     * @param array $data
     * @param int $userId
     * @return object
     */
    public function updateUser($data, $userId)
    {
        $statement = $this->database->prepare(UserQuery::UPDATE_USER_QUERY);
        $statement->bindParam('id', $userId);
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('email', $data['email']);
        $statement->execute();
        $user = $this->checkUser($userId);

        return $user;
    }

    /**
     * Delete a user.
     *
     * @param int $userId
     * @return string
     */
    public function deleteUser($userId)
    {
        $statement = $this->database->prepare(UserQuery::DELETE_USER_QUERY);
        $statement->bindParam('id', $userId);
        $statement->execute();

        return UserMessage::USER_DELETED;
    }
}

<?php

namespace App\Service;

use App\Message\UserMessage;
use App\Service\ValidationService as vs;
use App\Repository\UserRepository;

/**
 * Users Service.
 */
class UserService extends BaseService
{
    /**
     * @param object $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Check if the user exists.
     *
     * @param int $userId
     * @return object $user
     * @throws \Exception
     */
    public function checkUser($userId)
    {
        $repo = new UserRepository;
        $stmt = $this->database->prepare($repo->getUserQuery());
        $stmt->bindParam('id', $userId);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if (!$user) {
            throw new \Exception(UserMessage::USER_NOT_FOUND, 404);
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
        $repository = new UserRepository;
        $query = $repository->getUsersQuery();
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Get one user by id.
     *
     * @param int $userId
     * @return array
     */
    public function getUser($userId)
    {
        $user = $this->checkUser($userId);

        return $user;
    }

    /**
     * Search users by name.
     *
     * @param string $str
     * @return array
     * @throws \Exception
     */
    public function searchUsers($str)
    {
        $repo = new UserRepository;
        $stmt = $this->database->prepare($repo->searchUsersQuery());
        $name = '%' . $str . '%';
        $stmt->bindParam('name', $name);
        $stmt->execute();
        $users = $stmt->fetchAll();
        if (!$users) {
            throw new \Exception(UserMessage::USER_NAME_NOT_FOUND, 404);
        }

        return $users;
    }

    /**
     * Create a user.
     *
     * @param array $input
     * @return array
     * @throws \Exception
     */
    public function createUser($input)
    {
        $data = vs::validateInputOnCreateUser($input);
        $repository = new UserRepository;
        $query = $repository->createUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('email', $data['email']);
        $statement->execute();
        $user = $this->checkUser($this->database->lastInsertId());

        return $user;
    }

    /**
     * Update a user.
     *
     * @param array $input
     * @param int $userId
     * @return array
     * @throws \Exception
     */
    public function updateUser($input, $userId)
    {
        $user = $this->checkUser($userId);
        $data = vs::validateInputOnUpdateUser($input, $user);
        $repository = new UserRepository;
        $query = $repository->updateUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->bindParam('name', $data['name']);
        $statement->bindParam('email', $data['email']);
        $statement->execute();

        return $this->checkUser($userId);
    }

    /**
     * Delete a user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser($userId)
    {
        $this->checkUser($userId);
        $repository = new UserRepository;
        $query = $repository->deleteUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();

        return UserMessage::USER_DELETED;
    }
}

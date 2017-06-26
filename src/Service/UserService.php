<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Validation\UserValidation as vs;

/**
 * Users Service.
 */
class UserService extends BaseService
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
     * @param int $userId
     * @return object
     */
    protected function checkUser($userId)
    {
        $repository = new UserRepository($this->database);
        $user = $repository->checkUser($userId);

        return $user;
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        $repository = new UserRepository($this->database);
        $users = $repository->getUsers();

        return $users;
    }

    /**
     * Get one user by id.
     *
     * @param int $userId
     * @return object
     */
    public function getUser($userId)
    {
        $user = $this->checkUser($userId);

        return $user;
    }

    /**
     * Search users by name.
     *
     * @param string $usersName
     * @return array
     */
    public function searchUsers($usersName)
    {
        $repository = new UserRepository($this->database);
        $users = $repository->searchUsers($usersName);

        return $users;
    }

    /**
     * Create a user.
     *
     * @param array $input
     * @return object
     */
    public function createUser($input)
    {
        $repository = new UserRepository($this->database);
        $data = vs::validateInputOnCreateUser($input);
        $user = $repository->createUser($data);

        return $user;
    }

    /**
     * Update a user.
     *
     * @param array $input
     * @param int $userId
     * @return object
     */
    public function updateUser($input, $userId)
    {
        $checkUser = $this->checkUser($userId);
        $data = vs::validateInputOnUpdateUser($input, $checkUser);
        $repository = new UserRepository($this->database);
        $user = $repository->updateUser($data, $userId);

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
        $this->checkUser($userId);
        $repository = new UserRepository($this->database);
        $response = $repository->deleteUser($userId);

        return $response;
    }
}

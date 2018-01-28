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
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Check if the user exists.
     *
     * @param int $userId
     * @return object
     */
    protected function checkUser($userId)
    {
        $user = $this->userRepository->checkUser($userId);

        return $user;
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        $users = $this->userRepository->getUsers();

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
        $users = $this->userRepository->searchUsers($usersName);

        return $users;
    }

    /**
     * Create a user.
     *
     * @param array|object|null $input
     * @return object
     */
    public function createUser($input)
    {
        $data = vs::validateInputOnCreateUser($input);
        $user = $this->userRepository->createUser($data);

        return $user;
    }

    /**
     * Update a user.
     *
     * @param array|object|null $input
     * @param int $userId
     * @return object
     */
    public function updateUser($input, $userId)
    {
        $checkUser = $this->checkUser($userId);
        $data = vs::validateInputOnUpdateUser($input, $checkUser);
        $user = $this->userRepository->updateUser($data, $userId);

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
        $response = $this->userRepository->deleteUser($userId);

        return $response;
    }
}

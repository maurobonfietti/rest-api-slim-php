<?php

namespace App\Service;

use App\Exception\UserException;
use App\Repository\UserRepository;

/**
 * Users Service.
 */
class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

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
        return $this->userRepository->checkUser($userId);
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    /**
     * Get one user by id.
     *
     * @param int $userId
     * @return object
     */
    public function getUser($userId)
    {
        return $this->checkUser($userId);
    }

    /**
     * Search users by name.
     *
     * @param string $usersName
     * @return array
     */
    public function searchUsers($usersName)
    {
        return $this->userRepository->searchUsers($usersName);
    }

    /**
     * Create a user.
     *
     * @param array $input
     * @return object
     */
    public function createUser($input)
    {
        if (!isset($input['name'])) {
            throw new UserException(UserException::USER_NAME_REQUIRED, 400);
        }
        $name = self::validateName($input['name']);
        $email = null;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }
        $data = ['name' => $name, 'email' => $email];

        return $this->userRepository->createUser($data);
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
        $user = $this->checkUser($userId);
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new UserException(UserException::USER_INFO_REQUIRED, 400);
        }
        if (isset($input['name'])) {
            $user->name = self::validateName($input['name']);
        }
        if (isset($input['email'])) {
            $user->email = self::validateEmail($input['email']);
        }

        return $this->userRepository->updateUser($user);
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

        return $this->userRepository->deleteUser($userId);
    }
}

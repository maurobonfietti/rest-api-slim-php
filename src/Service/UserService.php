<?php

namespace App\Service;

use App\Exception\UserException;
use App\Repository\UserRepository;
use \Firebase\JWT\JWT;

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
    protected function checkAndGetUser($userId)
    {
        return $this->userRepository->checkAndGetUser($userId);
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
        return $this->checkAndGetUser($userId);
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
     * @throws UserException
     */
    public function createUser($input)
    {
        $user = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new UserException('The field "name" is required.', 400);
        }
        if (!isset($data->email)) {
            throw new UserException('The field "email" is required.', 400);
        }
        if (!isset($data->password)) {
            throw new UserException('The field "password" is required.', 400);
        }
        $user->name = self::validateUserName($data->name);
        $user->email = self::validateEmail($data->email);
        $user->password = hash('sha512', $data->password);

        return $this->userRepository->createUser($user);
    }

    /**
     * Update a user.
     *
     * @param array $input
     * @param int $userId
     * @return object
     * @throws UserException
     */
    public function updateUser($input, $userId)
    {
        $user = $this->checkAndGetUser($userId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->email)) {
            throw new UserException('Enter the data to update the user.', 400);
        }
        if (isset($data->name)) {
            $user->name = self::validateUserName($data->name);
        }
        if (isset($data->email)) {
            $user->email = self::validateEmail($data->email);
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
        $this->checkAndGetUser($userId);

        return $this->userRepository->deleteUser($userId);
    }

    /**
     * Login a user.
     *
     * @param array $input
     * @return string
     */
    public function login($input)
    {
        $data = json_decode(json_encode($input), false);
        $password = hash('sha512', $data->password);
        $user = $this->userRepository->login($data->email, $password);
        $token = array(
            'sub' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'iat' => time(),
            'exp' => time() + (7 * 24 * 60 * 60),
        );

        return JWT::encode($token, 'no_secret_example_key');
    }
}

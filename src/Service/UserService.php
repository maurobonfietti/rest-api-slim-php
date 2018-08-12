<?php

namespace App\Service;

use App\Exception\UserException;
use App\Repository\UserRepository;
use App\Validation\UserValidation as vs;

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
     * @param array $input
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
     * @param array $input
     * @param int $userId
     * @return object
     */
    public function updateUser($input, $userId)
    {
        $checkUser = $this->checkUser($userId);
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new UserException(UserException::USER_INFO_REQUIRED, 400);
        }
        $data = [];
        $data['name'] = vs::validateNameOnUpdateUser($input, $checkUser);
        $data['email'] = vs::validateEmailOnUpdateUser($input, $checkUser);
        $user = $this->userRepository->updateUser($data, $userId);

//        $client = new \Predis\Client();
//        $key = 'api-rest-slimphp:user:'.$userId;
//        $client->set($key, json_encode($user));

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

<?php

namespace App\Controller;

use App\Controller\Base;
use App\Service\UsersService;

/**
 * Users administration.
 */
class UsersController extends Base
{
    /**
     * Constructor of the class.
     *
     * @param object $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        $service = new UsersService($this->database);
        $response = $service->getUsers();

        return self::response('success', $response, 200);
    }

    /**
     * Get one user by id.
     *
     * @param int $userId
     * @return array
     */
    public function getUser($userId)
    {
        try {
            $service = new UsersService($this->database);
            $response = $service->getUser($userId);

            return self::response('success', $response, 200);
        } catch (\Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search users by name.
     *
     * @param string $usersStr
     * @return array
     */
    public function searchUsers($usersStr)
    {
        try {
            $service = new UsersService($this->database);
            $response = $service->searchUsers($usersStr);

            return self::response('success', $response, 200);
        } catch (\Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create user.
     *
     * @param mixed $request
     * @return array
     */
    public function createUser($request)
    {
        try {
            $service = new UsersService($this->database);
            $response = $service->createUser($request);

            return self::response('success', $response, 200);
        } catch (\Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update user.
     *
     * @param mixed $request
     * @param int $userId
     * @return array
     */
    public function updateUser($request, $userId)
    {
        try {
            $service = new UsersService($this->database);
            $response = $service->updateUser($request, $userId);

            return self::response('success', $response, 200);
        } catch (\Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser($userId)
    {
        try {
            $service = new UsersService($this->database);
            $response = $service->deleteUser($userId);

            return self::response('success', $response, 200);
        } catch (\Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

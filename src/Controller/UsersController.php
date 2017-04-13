<?php

/**
 * Users administration.
 */
class UsersController extends Base
{
    /**
     * Get all users
     *
     * @param mixed $database
     * @return array
     */
    public static function getUsers($database)
    {
        $service = new UsersService;

        return $service->getUsers($database);
    }

    /**
     * Get one user by id
     *
     * @param mixed $database
     * @param int $userId
     * @return array
     */
    public static function getUser($database, $userId)
    {
        $service = new UsersService;

        return $service->getUser($database, $userId);
    }

    /**
     * Search users by name
     *
     * @param mixed $database
     * @param string $usersStr
     * @return array
     */
    public static function searchUsers($database, $usersStr)
    {
        $service = new UsersService;

        return $service->searchUsers($database, $usersStr);
    }

    /**
     * Create user
     *
     * @param mixed $database
     * @param mixed $request
     * @return array
     */
    public static function createUser($database, $request)
    {
        $service = new UsersService;

        return $service->createUser($database, $request);
    }

    /**
     * Update user
     *
     * @param mixed $database
     * @param mixed $request
     * @param int $userId
     * @return array
     */
    public static function updateUser($database, $request, $userId)
    {
        $service = new UsersService;

        return $service->updateUser($database, $request, $userId);
    }

    /**
     * Delete user
     *
     * @param mixed $database
     * @param int $userId
     * @return array
     */
    public static function deleteUser($database, $userId)
    {
        $service = new UsersService;

        return $service->deleteUser($database, $userId);
    }
}

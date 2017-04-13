<?php

/**
 * Users administration.
 */
class UsersController extends Base
{
    /**
     * Get all users.
     *
     * @param mixed $database
     * @return array
     */
    public static function getUsers($database)
    {
        $service = new UsersService;
        $response = $service->getUsers($database);

        return self::response('success', $response, 200);
    }

    /**
     * Get one user by id.
     *
     * @param mixed $database
     * @param int $userId
     * @return array
     */
    public static function getUser($database, $userId)
    {
        try {
            $service = new UsersService;
            $response = $service->getUser($database, $userId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search users by name.
     *
     * @param mixed $database
     * @param string $usersStr
     * @return array
     */
    public static function searchUsers($database, $usersStr)
    {
        try {
            $service = new UsersService;
            $response = $service->searchUsers($database, $usersStr);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create user.
     *
     * @param mixed $database
     * @param mixed $request
     * @return array
     */
    public static function createUser($database, $request)
    {
        try {
            $service = new UsersService;
            $response = $service->createUser($database, $request);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update user.
     *
     * @param mixed $database
     * @param mixed $request
     * @param int $userId
     * @return array
     */
    public static function updateUser($database, $request, $userId)
    {
        try {
            $service = new UsersService;
            $response = $service->updateUser($database, $request, $userId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete user.
     *
     * @param mixed $database
     * @param int $userId
     * @return array
     */
    public static function deleteUser($database, $userId)
    {
        try {
            $service = new UsersService;
            $response = $service->deleteUser($database, $userId);

            return self::response('success', $response, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

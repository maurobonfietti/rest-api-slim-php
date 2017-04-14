<?php

/**
 * Users administration.
 */
class UsersController extends Base
{
    private $database;

    /**
     * Constructor of the class.
     *
     * @param object $database
     */
    public function __construct(PDO $database = null)
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

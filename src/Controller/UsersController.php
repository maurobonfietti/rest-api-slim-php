<?php

/**
 * Users administration.
 */
class UsersController extends Base
{
    /**
     * Check if the user exists.
     *
     * @param mixed $database
     * @param int $id
     * @return object $user
     * @throws Exception
     */
    private static function checkUser($database, $id)
    {
        $repository = new UsersRepository;
        $query = $repository->getUserQuery();
        $statement = $database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $user = $statement->fetchObject();
        if (!$user) {
            throw new Exception(self::USER_NOT_FOUND, 404);
        }

        return $user;
    }

    /**
     * Get all users
     *
     * @param mixed $database
     * @return array
     */
    public static function getUsers($database)
    {
        $repository = new UsersRepository;
        $query = $repository->getUsersQuery();
        $statement = $database->prepare($query);
        $statement->execute();

        return self::response('success', $statement->fetchAll(), 200);
    }

    /**
     * Get one user by id
     *
     * @param mixed $database
     * @param int $id
     * @return array
     */
    public static function getUser($database, $id)
    {
        try {
            $user = self::checkUser($database, $id);

            return self::response('success', $user, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
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
        $repository = new UsersRepository;
        $query = $repository->searchUsersQuery();
        $statement = $database->prepare($query);
        $name = '%'.$usersStr.'%';
        $statement->bindParam('name', $name);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            return self::response('error', self::USER_NAME_NOT_FOUND, 404);
        }

        return self::response('success', $users, 200);
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
        $input = $request->getParsedBody();
        if (empty($input['name'])) {
            return self::response('error', self::USER_NAME_REQUIRED, 400);
        }
        $repository = new UsersRepository;
        $query = $repository->createUserQuery();
        $statement = $database->prepare($query);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $user = self::checkUser($database, $database->lastInsertId());

        return self::response('success', $user, 200);
    }

    /**
     * Update user
     *
     * @param mixed $database
     * @param mixed $request
     * @param int $id
     * @return array
     */
    public static function updateUser($database, $request, $id)
    {
        try {
            $user = self::checkUser($database, $id);
            $input = $request->getParsedBody();
            if (empty($input['name']) && empty($input['email'])) {
                return self::response('error', self::USER_INFO_REQUIRED, 400);
            }
            $username = isset($input['name']) ? $input['name'] : $user->name;
            $email = isset($input['email']) ? $input['email'] : $user->email;
            $repository = new UsersRepository;
            $query = $repository->updateUserQuery();
            $statement = $database->prepare($query);
            $statement->bindParam('id', $id);
            $statement->bindParam('name', $username);
            $statement->bindParam('email', $email);
            $statement->execute();
            $user = self::checkUser($database, $id);

            return self::response('success', $user, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete user
     *
     * @param mixed $database
     * @param int $id
     * @return array
     */
    public static function deleteUser($database, $id)
    {
        try {
            self::checkUser($database, $id);
            $repository = new UsersRepository;
            $query = $repository->deleteUserQuery();
            $statement = $database->prepare($query);
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', self::USER_DELETED, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

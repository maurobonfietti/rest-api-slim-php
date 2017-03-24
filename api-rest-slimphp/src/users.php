<?php

class users
{
    const USER_NOT_FOUND = 'El usuario solicitado no existe.';

    const USER_NAME_NOT_FOUND = 'No se encontraron usuarios con ese nombre.';

    const USER_NAME_REQUIRED = 'Ingrese el nombre del usuario.';

    const USER_DELETED = 'El usuario fue eliminado correctamente.';

    /**
     * Response with a standard format.
     *
     * @param string $status
     * @param mixed $message
     * @param int $code
     * @return array $response
     */
    private static function response($status, $message, $code)
    {
        $response = [
            'status'  => $status,
            'code'    => $code,
            'message' => $message,
        ];

        return $response;
    }

    /**
     * Check if the user exists.
     *
     * @param mixed $db
     * @param int $id
     * @return object $user
     * @throws Exception
     */
    private static function checkUser($db, $id)
    {
        $query = self::getUserQuery();
        $statement = $db->prepare($query);
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
     * @param mixed $db
     * @return array
     */
    public static function getUsers($db)
    {
        $query = self::getUsersQuery();
        $statement = $db->prepare($query);
        $statement->execute();

        return self::response('success', $statement->fetchAll(), 200);
    }

    /**
     * Get one user by id
     *
     * @param mixed $db
     * @param int $id
     * @return array
     */
    public static function getUser($db, $id)
    {
        try {
            $user = self::checkUser($db, $id);

            return self::response('success', $user, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search users by name
     *
     * @param mixed $db
     * @param string $usersStr
     * @return array
     */
    public static function searchUsers($db, $usersStr)
    {
        $query = self::searchUsersQuery();
        $statement = $db->prepare($query);
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
     * @param mixed $db
     * @param mixed $request
     * @return array
     */
    public static function createUser($db, $request)
    {
        $input = $request->getParsedBody();
        if (empty($input['name'])) {
            return self::response('error', self::USER_NAME_REQUIRED, 400);
        }
        $query = self::createUserQuery();
        $statement = $db->prepare($query);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $input['id'] = $db->lastInsertId();

        return self::response('success', $input, 200);
    }

    /**
     * Update user
     *
     * @param mixed $db
     * @param mixed $request
     * @param int $id
     * @return array
     */
    public static function updateUser($db, $request, $id)
    {
        try {
            self::checkUser($db, $id);
            $input = $request->getParsedBody();
            if (empty($input['name'])) {
                return self::response('error', self::USER_NAME_REQUIRED, 400);
            }
            $query = self::updateUserQuery();
            $statement = $db->prepare($query);
            $statement->bindParam('id', $id);
            $statement->bindParam('name', $input['name']);
            $statement->execute();
            $input['id'] = $id;

            return self::response('success', $input, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete user
     *
     * @param mixed $db
     * @param int $id
     * @return array
     */
    public static function deleteUser($db, $id)
    {
        try {
            self::checkUser($db, $id);
            $query = self::deleteUserQuery();
            $statement = $db->prepare($query);
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', self::USER_DELETED, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    private static function getUserQuery()
    {
        return 'SELECT * FROM users WHERE id=:id';
    }

    private static function getUsersQuery()
    {
        return 'SELECT * FROM users ORDER BY id';
    }

    private static function searchUsersQuery()
    {
        return 'SELECT * FROM users WHERE UPPER(name) LIKE :name ORDER BY id';
    }

    private static function createUserQuery()
    {
        return 'INSERT INTO users (name) VALUES (:name)';
    }

    private static function updateUserQuery()
    {
        return 'UPDATE users SET name=:name WHERE id=:id';
    }

    private static function deleteUserQuery()
    {
        return 'DELETE FROM users WHERE id=:id';
    }
}

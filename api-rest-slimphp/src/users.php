<?php

class users
{
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
        $statement = $db->prepare('SELECT * FROM users WHERE id=:id');
        $statement->bindParam('id', $id);
        $statement->execute();
        $user = $statement->fetchObject();
        if (!$user) {
            throw new Exception('El usuario solicitado no existe.', 404);
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
        $statement = $db->prepare('SELECT * FROM users ORDER BY id');
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
        $statement = $db->prepare(
            'SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY id'
        );
        $query = '%'.$usersStr.'%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            return self::response('error', 'No se encontraron usuarios con ese nombre.', 404);
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
            return self::response('error', 'Ingrese el nombre del usuario.', 400);
        }
        $sql = 'INSERT INTO users (name) VALUES (:name)';
        $statement = $db->prepare($sql);
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
                return self::response('error', 'Ingrese el nombre del usuario.', 400);
            }
            $sql = 'UPDATE users SET name=:name WHERE id=:id';
            $statement = $db->prepare($sql);
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
            $statement = $db->prepare('DELETE FROM users WHERE id=:id');
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', 'El usuario fue eliminado correctamente.', 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

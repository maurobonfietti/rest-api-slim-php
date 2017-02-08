<?php

class users
{
    public static function checkUser($db, $id)
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

    public static function getUsers($db)
    {
        $statement = $db->prepare('SELECT * FROM users ORDER BY id');
        $statement->execute();
        $response = [
            'success' => $statement->fetchAll(),
            'code' => 200,
        ];

        return $response;
    }

    public static function getUser($db, $id)
    {
        try {
            $user = self::checkUser($db, $id);
            $response = [
                'success' => $user,
                'code' => 200,
            ];

            return $response;
        } catch (Exception $ex) {
            $response = [
                'error' => $ex->getMessage(),
                'code' => $ex->getCode(),
            ];

            return $response;
        }
    }

    public static function searchUsers($db, $usersStr)
    {
        $statement = $db->prepare('SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY id');
        $query = '%'.$usersStr.'%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            $response = [
                'error' => 'No se encontraron usuarios con ese nombre.',
                'code' => 404,
            ];

            return $response;
        }
        $response = [
            'success' => $users,
            'code' => 200,
        ];

        return $response;
    }

    public static function createUser($db, $request)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO users (name) VALUES (:name)';
        $statement = $db->prepare($sql);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $input['id'] = $db->lastInsertId();
        $response = [
            'success' => $input,
            'code' => 200,
        ];

        return $response;
    }

    public static function updateUser($db, $request, $id)
    {
        try {
            self::checkUser($db, $id);
            $input = $request->getParsedBody();
            $sql = 'UPDATE users SET name=:name WHERE id=:id';
            $statement = $db->prepare($sql);
            $statement->bindParam('id', $id);
            $statement->bindParam('name', $input['name']);
            $statement->execute();
            $input['id'] = $id;
            $response = [
                'success' => $input,
                'code' => 200,
            ];

            return $response;
        } catch (Exception $ex) {
            $response = [
                'error' => $ex->getMessage(),
                'code' => $ex->getCode(),
            ];

            return $response;
        }
    }

    public static function deleteUser($db, $id)
    {
        try {
            self::checkUser($db, $id);
            $statement = $db->prepare('DELETE FROM users WHERE id=:id');
            $statement->bindParam('id', $id);
            $statement->execute();
            $response = [
                'success' => 'El usuario fue eliminado correctamente.',
                'code' => 200,
            ];

            return $response;
        } catch (Exception $ex) {
            $response = [
                'error' => $ex->getMessage(),
                'code' => $ex->getCode(),
            ];

            return $response;
        }
    }
}

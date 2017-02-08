<?php

class users
{
    public static function response($status, $message, $code)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'code' => $code,
        ];

        return $response;
    }

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

        return self::response('success', $statement->fetchAll(), 200);
    }

    public static function getUser($db, $id)
    {
        try {
            $user = self::checkUser($db, $id);

            return self::response('success', $user, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
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
            return self::response('error', 'No se encontraron usuarios con ese nombre.', 404);
        }

        return self::response('success', $users, 200);
    }

    public static function createUser($db, $request)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO users (name) VALUES (:name)';
        $statement = $db->prepare($sql);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $input['id'] = $db->lastInsertId();

        return self::response('success', $input, 200);
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

            return self::response('success', $input, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

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

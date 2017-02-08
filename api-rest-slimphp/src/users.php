<?php

class users
{
    public static function response($code = 200, $status = '', $message = '')
    {
        header('Content-Type: application/json');
        http_response_code($code);
        $response = array($status => $message);
        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }

    public static function getUsers($db)
    {
        $statement = $db->prepare('SELECT * FROM users ORDER BY id');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getUser($db, $id)
    {
        $statement = $db->prepare('SELECT * FROM users WHERE id=:id');
        $statement->bindParam('id', $id);
        $statement->execute();
        $user = $statement->fetchObject();
        if (!$user) {
            self::response(404, 'error', 'El usuario solicitado no existe.');
        }

        return $user;
    }

    public static function searchUsers($db, $usersStr)
    {
        $statement = $db->prepare('SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY id');
        $query = '%'.$usersStr.'%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            self::response(404, 'error', 'No se encontraron usuarios con ese nombre.');
        }

        return $users;
    }

    public static function createUser($db, $request)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO users (name) VALUES (:name)';
        $statement = $db->prepare($sql);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $input['id'] = $db->lastInsertId();

        return $input;
    }

    public static function updateUser($db, $request, $id)
    {
        self::getUser($db, $id);
        $input = $request->getParsedBody();
        $sql = 'UPDATE users SET name=:name WHERE id=:id';
        $statement = $db->prepare($sql);
        $statement->bindParam('id', $id);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $input['id'] = $id;

        return $input;
    }

    public static function deleteUser($db, $id)
    {
        self::getUser($db, $id);
        $statement = $db->prepare('DELETE FROM users WHERE id=:id');
        $statement->bindParam('id', $id);
        $statement->execute();

        return self::response(200, 'success', 'El usuario fue eliminado correctamente.');
    }
}

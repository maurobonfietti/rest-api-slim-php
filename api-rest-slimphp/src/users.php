<?php

class users
{
    public static function checkExistUser($db, $id)
    {
        $statement = $db->prepare('SELECT * FROM users WHERE id=:id');
        $statement->bindParam('id', $id);
        $statement->execute();
        $user = $statement->fetchObject();
        if (!$user) {
            header('Content-Type: application/json');
            http_response_code(404);
            $response = array('error' => 'El usuario solicitado no existe.');
            echo json_encode($response, JSON_PRETTY_PRINT);
            exit;
        }

        return $user;
    }

    public static function getUsers($db)
    {
        $statement = $db->prepare('SELECT * FROM users ORDER BY id');
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function getUser($db, $id)
    {
        return self::checkExistUser($db, $id);
    }

    public static function searchUsers($db, $usersStr)
    {
        $statement = $db->prepare('SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY id');
        $query = '%'.$usersStr.'%';
        $statement->bindParam('query', $query);
        $statement->execute();

        return $statement->fetchAll();
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
        $statement = $db->prepare('DELETE FROM users WHERE id=:id');
        $statement->bindParam('id', $id);
        $statement->execute();

        return true;
    }
}

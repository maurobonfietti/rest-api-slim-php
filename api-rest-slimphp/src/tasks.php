<?php

class tasks
{
    public static function getAllTasks($db)
    {
        $sth = $db->prepare('SELECT * FROM tasks ORDER BY task');
        $sth->execute();
        $todos = $sth->fetchAll();

        return $todos;
    }

    public static function getTask($request, $response, $args, $db)
    {
        $sth = $db->prepare('SELECT * FROM tasks WHERE id=:id');
        $sth->bindParam('id', $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();

        return $todos;
    }

    public static function searchtTasks($request, $response, $args, $db)
    {
        $sth = $db->prepare('SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task');
        $query = '%'.$args['query'].'%';
        $sth->bindParam('query', $query);
        $sth->execute();
        $todos = $sth->fetchAll();

        return $todos;
    }

    public static function createTask($request, $db)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO tasks (task) VALUES (:task)';
        $sth = $db->prepare($sql);
        $sth->bindParam('task', $input['task']);
        $sth->execute();
        $input['id'] = $db->lastInsertId();

        return $input;
    }

    public static function updateTask($request, $response, $args, $db)
    {
        $input = $request->getParsedBody();
        $sql = 'UPDATE tasks SET task=:task WHERE id=:id';
        $sth = $db->prepare($sql);
        $sth->bindParam('id', $args['id']);
        $sth->bindParam('task', $input['task']);
        $sth->execute();
        $input['id'] = $args['id'];

        return $input;
    }

    public static function deleteTask($request, $response, $args, $db)
    {
        $sth = $db->prepare('DELETE FROM tasks WHERE id=:id');
        $sth->bindParam('id', $args['id']);
        $sth->execute();

        return true;
    }
}

<?php

class tasks
{
    public static function getTasks($db)
    {
        $sth = $db->prepare('SELECT * FROM tasks ORDER BY task');
        $sth->execute();
        $todos = $sth->fetchAll();

        return $todos;
    }

    public static function getTask($db, $id)
    {
        $sth = $db->prepare('SELECT * FROM tasks WHERE id=:id');
        $sth->bindParam('id', $id);
        $sth->execute();
        $todos = $sth->fetchObject();

        return $todos;
    }

    public static function searchTasks($db, $tasks)
    {
        $sth = $db->prepare('SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task');
        $query = '%'.$tasks.'%';
        $sth->bindParam('query', $query);
        $sth->execute();
        $todos = $sth->fetchAll();

        return $todos;
    }

    public static function createTask($db, $request)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO tasks (task) VALUES (:task)';
        $sth = $db->prepare($sql);
        $sth->bindParam('task', $input['task']);
        $sth->execute();
        $input['id'] = $db->lastInsertId();

        return $input;
    }

    public static function updateTask($db, $request, $id)
    {
        $input = $request->getParsedBody();
        $sql = 'UPDATE tasks SET task=:task WHERE id=:id';
        $sth = $db->prepare($sql);
        $sth->bindParam('id', $id);
        $sth->bindParam('task', $input['task']);
        $sth->execute();
        $input['id'] = $id;

        return $input;
    }

    public static function deleteTask($db, $id)
    {
        $sth = $db->prepare('DELETE FROM tasks WHERE id=:id');
        $sth->bindParam('id', $id);
        $sth->execute();

        return true;
    }
}

<?php

class tasks
{
    /**
     * Response with a standard format.
     *
     * @param  string $status
     * @param  mixed  $message
     * @param  int    $code
     * @return array  $response
     */
    private static function response($status, $message, $code)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'code' => $code,
        ];

        return $response;
    }

    /**
     * Check if the task exists.
     *
     * @param mixed   $db
     * @param int     $id
     * @return object $task
     * @throws Exception
     */
    private static function checkTask($db, $id)
    {
        $statement = $db->prepare('SELECT * FROM tasks WHERE id=:id');
        $statement->bindParam('id', $id);
        $statement->execute();
        $task = $statement->fetchObject();
        if (!$task) {
            throw new Exception('La tarea solicitada no existe.', 404);
        }

        return $task;
    }

    public static function getTasks($db)
    {
        $statement = $db->prepare('SELECT * FROM tasks ORDER BY task');
        $statement->execute();

        return self::response('success', $statement->fetchAll(), 200);
    }

    public static function getTask($db, $id)
    {
        try {
            $task = self::checkTask($db, $id);

            return self::response('success', $task, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
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

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

    public static function searchTasks($db, $tasksName)
    {
        $statement = $db->prepare('SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task');
        $query = '%'.$tasksName.'%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $tasks = $statement->fetchAll();
        if (!$tasks) {
            return self::response('error', 'No se encontraron tareas con ese nombre.', 404);
        }

        return self::response('success', $tasks, 200);
    }

    public static function createTask($db, $request)
    {
        $input = $request->getParsedBody();
        $sql = 'INSERT INTO tasks (task) VALUES (:task)';
        $statement = $db->prepare($sql);
        $statement->bindParam('task', $input['task']);
        $statement->execute();
        $input['id'] = $db->lastInsertId();

        return $input;
    }

    public static function updateTask($db, $request, $id)
    {
        try {
            self::checkTask($db, $id);
            $input = $request->getParsedBody();
            $sql = 'UPDATE tasks SET task=:task WHERE id=:id';
            $statement = $db->prepare($sql);
            $statement->bindParam('id', $id);
            $statement->bindParam('task', $input['task']);
            $statement->execute();
            $input['id'] = $id;

            return self::response('success', $input, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    public static function deleteTask($db, $id)
    {
        try {
            self::checkTask($db, $id);
            $statement = $db->prepare('DELETE FROM tasks WHERE id=:id');
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', 'La tarea fue eliminada correctamente.', 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

<?php

class tasks
{
    const TASK_NOT_FOUND = 'La tarea solicitada no existe.';

    const TASK_NAME_NOT_FOUND = 'No se encontraron tareas con ese nombre.';

    const TASK_NAME_REQUIRED = 'Ingrese el nombre de la tarea.';

    const TASK_DELETED = 'La tarea fue eliminada correctamente.';

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
     * Check if the task exists.
     *
     * @param mixed $db
     * @param int $id
     * @return object $task
     * @throws Exception
     */
    private static function checkTask($db, $id)
    {
        $query = self::getTaskQuery();
        $statement = $db->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $task = $statement->fetchObject();
        if (!$task) {
            throw new Exception(self::TASK_NOT_FOUND, 404);
        }

        return $task;
    }

    /**
     * Get all tasks
     * @param mixed $db
     * @return array
     */
    public static function getTasks($db)
    {
        $query = self::getTasksQuery();
        $statement = $db->prepare($query);
        $statement->execute();

        return self::response('success', $statement->fetchAll(), 200);
    }

    /**
     * Get one task by id
     *
     * @param mixed $db
     * @param int $id
     * @return array
     */
    public static function getTask($db, $id)
    {
        try {
            $task = self::checkTask($db, $id);

            return self::response('success', $task, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name
     *
     * @param mixed $db
     * @param string $tasksName
     * @return array
     */
    public static function searchTasks($db, $tasksName)
    {
        $query = self::searchTasksQuery();
        $statement = $db->prepare($query);
        $query = '%'.$tasksName.'%';
        $statement->bindParam('query', $query);
        $statement->execute();
        $tasks = $statement->fetchAll();
        if (!$tasks) {
            return self::response('error', self::TASK_NAME_NOT_FOUND, 404);
        }

        return self::response('success', $tasks, 200);
    }

    /**
     * Create task
     *
     * @param mixed $db
     * @param mixed $request
     * @return array
     */
    public static function createTask($db, $request)
    {
        $input = $request->getParsedBody();
        if (empty($input['task'])) {
            return self::response('error', self::TASK_NAME_REQUIRED, 400);
        }
        $query = self::createTaskQuery();
        $statement = $db->prepare($query);
        $statement->bindParam('task', $input['task']);
        $statement->execute();
        $input['id'] = $db->lastInsertId();

        return self::response('success', $input, 200);
    }

    /**
     * Update task
     *
     * @param mixed $db
     * @param mixed $request
     * @param int $id
     * @return array
     */
    public static function updateTask($db, $request, $id)
    {
        try {
            self::checkTask($db, $id);
            $input = $request->getParsedBody();
            if (empty($input['task'])) {
                return self::response('error', self::TASK_NAME_REQUIRED, 400);
            }
            $query = self::updateTaskQuery();
            $statement = $db->prepare($query);
            $statement->bindParam('id', $id);
            $statement->bindParam('task', $input['task']);
            $statement->execute();
            $input['id'] = $id;

            return self::response('success', $input, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete task
     *
     * @param mixed $db
     * @param int $id
     * @return array
     */
    public static function deleteTask($db, $id)
    {
        try {
            self::checkTask($db, $id);
            $query = self::deleteTaskQuery();
            $statement = $db->prepare($query);
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', self::TASK_DELETED, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
    
    private static function getTaskQuery()
    {
        return 'SELECT * FROM tasks WHERE id=:id';
    }

    private static function getTasksQuery()
    {
        return 'SELECT * FROM tasks ORDER BY task';
    }

    private static function searchTasksQuery()
    {
        return 'SELECT * FROM tasks WHERE UPPER(task) LIKE :query ORDER BY task';
    }

    private static function createTaskQuery()
    {
        return 'INSERT INTO tasks (task) VALUES (:task)';
    }

    private static function updateTaskQuery()
    {
        return 'UPDATE tasks SET task=:task WHERE id=:id';
    }

    private static function deleteTaskQuery()
    {
        return 'DELETE FROM tasks WHERE id=:id';
    }
}

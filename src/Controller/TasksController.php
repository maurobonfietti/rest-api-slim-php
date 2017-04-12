<?php

/**
 * Tasks administration.
 */
class TasksController extends Base
{
    /**
     * Check if the task exists.
     *
     * @param mixed $pdo
     * @param int $id
     * @return object $task
     * @throws Exception
     */
    private static function checkTask($pdo, $id)
    {
        $query = TasksRepository::getTaskQuery();
        $statement = $pdo->prepare($query);
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
     * @param mixed $pdo
     * @return array
     */
    public static function getTasks($pdo)
    {
        $query = TasksRepository::getTasksQuery();
        $statement = $pdo->prepare($query);
        $statement->execute();

        return self::response('success', $statement->fetchAll(), 200);
    }

    /**
     * Get one task by id
     *
     * @param mixed $pdo
     * @param int $id
     * @return array
     */
    public static function getTask($pdo, $id)
    {
        try {
            $task = self::checkTask($pdo, $id);

            return self::response('success', $task, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search tasks by name
     *
     * @param mixed $pdo
     * @param string $tasksName
     * @return array
     */
    public static function searchTasks($pdo, $tasksName)
    {
        $query = TasksRepository::searchTasksQuery();
        $statement = $pdo->prepare($query);
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
     * @param mixed $pdo
     * @param mixed $request
     * @return array
     */
    public static function createTask($pdo, $request)
    {
        $input = $request->getParsedBody();
        if (empty($input['task'])) {
            return self::response('error', self::TASK_NAME_REQUIRED, 400);
        }
        $query = TasksRepository::createTaskQuery();
        $statement = $pdo->prepare($query);
        $statement->bindParam('task', $input['task']);
        $statement->execute();
        $task = self::checkTask($pdo, $pdo->lastInsertId());

        return self::response('success', $task, 200);
    }

    /**
     * Update task
     *
     * @param mixed $pdo
     * @param mixed $request
     * @param int $id
     * @return array
     */
    public static function updateTask($pdo, $request, $id)
    {
        try {
            $task = self::checkTask($pdo, $id);
            $input = $request->getParsedBody();
            if (empty($input['task']) && empty($input['status'])) {
                return self::response('error', self::TASK_INFO_REQUIRED, 400);
            }
            $taskname = isset($input['task']) ? $input['task'] : $task->task;
            $status = isset($input['status']) ? $input['status'] : $task->status;
            $query = TasksRepository::updateTaskQuery();
            $statement = $pdo->prepare($query);
            $statement->bindParam('id', $id);
            $statement->bindParam('task', $taskname);
            $statement->bindParam('status', $status);
            $statement->execute();
            $task = self::checkTask($pdo, $id);

            return self::response('success', $task, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete task
     *
     * @param mixed $pdo
     * @param int $id
     * @return array
     */
    public static function deleteTask($pdo, $id)
    {
        try {
            self::checkTask($pdo, $id);
            $query = TasksRepository::deleteTaskQuery();
            $statement = $pdo->prepare($query);
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', self::TASK_DELETED, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

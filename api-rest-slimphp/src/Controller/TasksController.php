<?php

/**
 * Tasks administration.
 */
class TasksController extends Base
{
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
        $query = TasksRepository::getTaskQuery();
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
        $query = TasksRepository::getTasksQuery();
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
        $query = TasksRepository::searchTasksQuery();
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
        $query = TasksRepository::createTaskQuery();
        $statement = $db->prepare($query);
        $statement->bindParam('task', $input['task']);
        $statement->execute();
        $task = self::checkTask($db, $db->lastInsertId());

        return self::response('success', $task, 200);
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
            $task = self::checkTask($db, $id);
            $input = $request->getParsedBody();
            if (empty($input['task']) && empty($input['status'])) {
                return self::response('error', self::TASK_INFO_REQUIRED, 400);
            }
            $taskname = isset($input['task']) ? $input['task'] : $task->task;
            $status = isset($input['status']) ? $input['status'] : $task->status;
            $query = TasksRepository::updateTaskQuery();
            $statement = $db->prepare($query);
            $statement->bindParam('id', $id);
            $statement->bindParam('task', $taskname);
            $statement->bindParam('status', $status);
            $statement->execute();
            $task = self::checkTask($db, $id);

            return self::response('success', $task, 200);
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
            $query = TasksRepository::deleteTaskQuery();
            $statement = $db->prepare($query);
            $statement->bindParam('id', $id);
            $statement->execute();

            return self::response('success', self::TASK_DELETED, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

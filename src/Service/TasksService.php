<?php

/**
 * Tasks Service.
 */
class TasksService extends Base
{
    /**
     * Get all tasks
     *
     * @param mixed $database
     * @return array
     */
    public static function getTasks($database)
    {
        $repository = new TasksRepository;
        $query = $repository->getTasksQuery();
        $statement = $database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Get one task by id
     *
     * @param mixed $database
     * @param int $taskId
     * @return array
     */
    public static function getTask($database, $taskId)
    {
        $task = self::checkTask($database, $taskId);

        return $task;
    }

    /**
     * Search tasks by name
     *
     * @param mixed $database
     * @param string $tasksName
     * @return array
     */
    public static function searchTasks($database, $tasksName)
    {
        $repository = new TasksRepository;
        $query = $repository->searchTasksQuery();
        $statement = $database->prepare($query);
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
     * @param mixed $database
     * @param mixed $request
     * @return array
     */
    public static function createTask($database, $request)
    {
        $input = $request->getParsedBody();
        if (empty($input['task'])) {
            return self::response('error', self::TASK_NAME_REQUIRED, 400);
        }
        $repository = new TasksRepository;
        $query = $repository->createTaskQuery();
        $statement = $database->prepare($query);
        $statement->bindParam('task', $input['task']);
        $statement->execute();
        $task = self::checkTask($database, $database->lastInsertId());

        return self::response('success', $task, 200);
    }

    /**
     * Update task
     *
     * @param mixed $database
     * @param mixed $request
     * @param int $taskId
     * @return array
     */
    public static function updateTask($database, $request, $taskId)
    {
        try {
            $task = self::checkTask($database, $taskId);
            $input = $request->getParsedBody();
            if (empty($input['task']) && empty($input['status'])) {
                return self::response('error', self::TASK_INFO_REQUIRED, 400);
            }
            $taskname = isset($input['task']) ? $input['task'] : $task->task;
            $status = isset($input['status']) ? $input['status'] : $task->status;
            $repository = new TasksRepository;
            $query = $repository->updateTaskQuery();
            $statement = $database->prepare($query);
            $statement->bindParam('id', $taskId);
            $statement->bindParam('task', $taskname);
            $statement->bindParam('status', $status);
            $statement->execute();
            $task = self::checkTask($database, $taskId);

            return self::response('success', $task, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete task
     *
     * @param mixed $database
     * @param int $taskId
     * @return array
     */
    public static function deleteTask($database, $taskId)
    {
        try {
            self::checkTask($database, $taskId);
            $repository = new TasksRepository;
            $query = $repository->deleteTaskQuery();
            $statement = $database->prepare($query);
            $statement->bindParam('id', $taskId);
            $statement->execute();

            return self::response('success', self::TASK_DELETED, 200);
        } catch (Exception $ex) {
            return self::response('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

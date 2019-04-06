<?php

namespace App\Service;

use App\Exception\TaskException;
use App\Repository\TaskRepository;

/**
 * Tasks Service.
 */
class TaskService extends BaseService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return TaskRepository
     */
    protected function getTaskRepository()
    {
        return $this->taskRepository;
    }

    /**
     * Check if the task exists.
     *
     * @param int $taskId
     * @return object
     */
    protected function checkAndGetTask($taskId, $userId)
    {
        return $this->getTaskRepository()->checkAndGetTask($taskId, $userId);
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks($userId)
    {
        return $this->getTaskRepository()->getTasks($userId);
    }

    /**
     * Get one task by id.
     *
     * @param int $taskId
     * @return object
     */
    public function getTask($taskId, $userId)
    {
        return $this->checkAndGetTask($taskId, $userId);
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     */
    public function searchTasks($tasksName, $userId)
    {
        return $this->getTaskRepository()->searchTasks($tasksName, $userId);
    }

    /**
     * Create a task.
     *
     * @param array $input
     * @return object
     * @throws TaskException
     */
    public function createTask($input)
    {
        $task = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (empty($data->name)) {
            throw new TaskException('The field "name" is required.', 400);
        }
        $task->name = self::validateTaskName($data->name);
        $task->status = 0;
        if (isset($data->status)) {
            $task->status = self::validateTaskStatus($data->status);
        }
        $task->userId = $data->decoded->sub;

        return $this->getTaskRepository()->createTask($task);
    }

    /**
     * Update a task.
     *
     * @param array $input
     * @param int $taskId
     * @return object
     * @throws TaskException
     */
    public function updateTask($input, $taskId)
    {
        $task = $this->checkAndGetTask($taskId, $input['decoded']->sub);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->status)) {
            throw new TaskException('Enter the data to update the task.', 400);
        }
        if (isset($data->name)) {
            $task->name = self::validateTaskName($data->name);
        }
        if (isset($data->status)) {
            $task->status = self::validateTaskStatus($data->status);
        }
        $task->userId = $data->decoded->sub;

        return $this->getTaskRepository()->updateTask($task);
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return string
     */
    public function deleteTask($taskId, $userId)
    {
        $this->checkAndGetTask($taskId, $userId);

        return $this->getTaskRepository()->deleteTask($taskId, $userId);
    }
}

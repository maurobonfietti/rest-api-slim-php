<?php

namespace App\Service;

use App\Exception\TaskException;
use App\Repository\TaskRepository;

class TaskService extends BaseService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    protected function getTaskRepository(): TaskRepository
    {
        return $this->taskRepository;
    }

    protected function checkAndGetTask(int $taskId, int $userId)
    {
        return $this->getTaskRepository()->checkAndGetTask($taskId, $userId);
    }

    public function getTasks(int $userId): array
    {
        return $this->getTaskRepository()->getTasks($userId);
    }

    public function getTask(int $taskId, int $userId)
    {
        return $this->checkAndGetTask($taskId, $userId);
    }

    public function searchTasks(string $tasksName, int $userId): array
    {
        return $this->getTaskRepository()->searchTasks($tasksName, $userId);
    }

    public function createTask(array $input)
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

    public function updateTask(array $input, int $taskId)
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

    public function deleteTask(int $taskId, int $userId): string
    {
        $this->checkAndGetTask($taskId, $userId);

        return $this->getTaskRepository()->deleteTask($taskId, $userId);
    }
}

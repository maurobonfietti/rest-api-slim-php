<?php

declare(strict_types=1);

namespace App\Service\Task;

use App\Exception\Task;

final class TaskService extends Base
{
    public function getAllTasks(): array
    {
        return $this->getTaskRepository()->getAllTasks();
    }

    public function getAll(int $userId): array
    {
        return $this->getTaskRepository()->getAll($userId);
    }

    public function getOne(int $taskId, int $userId)
    {
        if (self::isRedisEnabled() === true) {
            $task = $this->getTaskFromCache($taskId, $userId);
        } else {
            $task = $this->getTaskFromDb($taskId, $userId);
        }

        return $task;
    }

    public function search(string $tasksName, int $userId, $status): array
    {
        if ($status !== null) {
            $status = (int) $status;
        }

        return $this->getTaskRepository()->search($tasksName, $userId, $status);
    }

    public function create(array $input)
    {
        $data = json_decode(json_encode($input), false);
        if (! isset($data->name)) {
            throw new Task('The field "name" is required.', 400);
        }
        self::validateTaskName($data->name);
        $data->description = $data->description ?? null;
        $status = 0;
        if (isset($data->status)) {
            $status = self::validateTaskStatus($data->status);
        }
        $data->status = $status;
        $data->userId = $data->decoded->sub;
        $task = $this->getTaskRepository()->create($data);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($task->id, $task->userId, $task);
        }

        return $task;
    }

    public function update(array $input, int $taskId)
    {
        $task = $this->getTaskFromDb($taskId, (int) $input['decoded']->sub);
        $data = json_decode(json_encode($input), false);
        if (! isset($data->name) && ! isset($data->status)) {
            throw new Task('Enter the data to update the task.', 400);
        }
        if (isset($data->name)) {
            $task->name = self::validateTaskName($data->name);
        }
        if (isset($data->description)) {
            $task->description = $data->description;
        }
        if (isset($data->status)) {
            $task->status = self::validateTaskStatus($data->status);
        }
        $task->userId = $data->decoded->sub;
        $tasks = $this->getTaskRepository()->update($task);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($tasks->id, $task->userId, $tasks);
        }

        return $tasks;
    }

    public function delete(int $taskId, int $userId): string
    {
        $this->getTaskFromDb($taskId, $userId);
        $data = $this->getTaskRepository()->delete($taskId, $userId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($taskId, $userId);
        }

        return $data;
    }
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\TaskException;
use App\Repository\TaskRepository;

class TaskService extends BaseService
{
    const REDIS_KEY = 'task:%s:user:%s';

    protected $taskRepository;

    protected $redisService;

    public function __construct(TaskRepository $taskRepository, RedisService $redisService)
    {
        $this->taskRepository = $taskRepository;
        $this->redisService = $redisService;
    }

    protected function getTaskRepository(): TaskRepository
    {
        return $this->taskRepository;
    }

    protected function getTaskFromDb(int $taskId, int $userId)
    {
        return $this->getTaskRepository()->checkAndGetTask($taskId, $userId);
    }

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

    public function getTaskFromCache(int $taskId, int $userId)
    {
        $redisKey = sprintf(self::REDIS_KEY, $taskId, $userId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $task = $this->redisService->get($key);
        } else {
            $task = $this->getTaskFromDb($taskId, $userId);
            $this->redisService->setex($key, $task);
        }

        return $task;
    }

    public function search($tasksName, int $userId, $status): array
    {
        if ($status !== null) {
            $status = (int) $status;
        }

        return $this->getTaskRepository()->search($tasksName, $userId, $status);
    }

    public function saveInCache($taskId, $userId, $tasks)
    {
        $redisKey = sprintf(self::REDIS_KEY, $taskId, $userId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $tasks);
    }

    public function deleteFromCache($taskId, $userId)
    {
        $redisKey = sprintf(self::REDIS_KEY, $taskId, $userId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del($key);
    }

    public function create(array $input)
    {
        $task = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (empty($data->name)) {
            throw new TaskException('The field "name" is required.', 400);
        }
        $task->name = self::validateTaskName($data->name);
        $task->description = null;
        if (isset($data->description)) {
            $task->description = $data->description;
        }
        $task->status = 0;
        if (isset($data->status)) {
            $task->status = self::validateTaskStatus($data->status);
        }
        $task->userId = $data->decoded->sub;
        $tasks = $this->getTaskRepository()->create($task);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($tasks->id, $task->userId, $tasks);
        }

        return $tasks;
    }

    public function update(array $input, int $taskId)
    {
        $task = $this->getTaskFromDb($taskId, (int) $input['decoded']->sub);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->status)) {
            throw new TaskException('Enter the data to update the task.', 400);
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

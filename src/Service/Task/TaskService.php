<?php

declare(strict_types=1);

namespace App\Service\Task;

use App\Entity\Task;
use App\Exception\Task as TaskException;

final class TaskService extends Base
{
    /**
     * @return array<string>
     */
    public function getTasksByPage(
        int $userId,
        int $page,
        int $perPage,
        ?string $name,
        ?string $description,
        ?string $status
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->getTaskRepository()->getTasksByPage(
            $userId,
            $page,
            $perPage,
            $name,
            $description,
            $status
        );
    }

    /**
     * @return array<string>
     */
    public function getAllTasks(): array
    {
        return $this->getTaskRepository()->getAllTasks();
    }

    public function getOne(int $taskId, int $userId): object
    {
        if (self::isRedisEnabled() === true) {
            $task = $this->getTaskFromCache($taskId, $userId);
        } else {
            $task = $this->getTaskFromDb($taskId, $userId)->toJson();
        }

        return $task;
    }

    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new \App\Exception\Task('The field "name" is required.', 400);
        }
        $mytask = $this->createTask($data);
        /** @var Task $task */
        $task = $this->getTaskRepository()->create($mytask);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache(
                $task->getId(),
                $task->getUserId(),
                $task->toJson()
            );
        }

        return $task->toJson();
    }

    public function createTask(object $data): Task
    {
        $task = new Task();
        $task->updateName(self::validateTaskName($data->name));
        $description = $data->description ?? null;
        $task->updateDescription($description);
        $status = 0;
        if (isset($data->status)) {
            $status = self::validateTaskStatus($data->status);
        }
        $task->updateStatus($status);
        $task->updateUserId(self::getUserIdFromToken($data));

        return $task;
    }

    /**
     * @param array<string> $input
     */
    public function update(array $input, int $taskId): object
    {
        $data = $this->validateTask($input, $taskId);
        /** @var Task $task */
        $task = $this->getTaskRepository()->update($data);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache(
                $task->getId(),
                $data->getUserId(),
                $task->toJson()
            );
        }

        return $task->toJson();
    }

    public function delete(int $taskId, int $userId): void
    {
        $this->getTaskFromDb($taskId, $userId);
        $this->getTaskRepository()->delete($taskId, $userId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($taskId, $userId);
        }
    }

    private function validateTask(array $input, int $taskId): Task
    {
        $data = json_decode((string) json_encode($input), false);
        $userId = self::getUserIdFromToken($data);
        $task = $this->getTaskFromDb($taskId, $userId);
        if (! isset($data->name) && ! isset($data->status)) {
            throw new TaskException('Enter the data to update the task.', 400);
        }
        if (isset($data->name)) {
            $task->updateName(self::validateTaskName($data->name));
        }
        if (isset($data->description)) {
            $task->updateDescription($data->description);
        }
        if (isset($data->status)) {
            $task->updateStatus(self::validateTaskStatus($data->status));
        }
        $task->updateUserId($userId);

        return $task;
    }

    /**
     * Tasks belong to a user (tasks.userId is NOT NULL), so a token without "sub" is rejected,
     * matching Controller\Task\Base::getAndValidateUserId().
     */
    private static function getUserIdFromToken(object $data): int
    {
        if (isset($data->decoded) && isset($data->decoded->sub)) {
            return (int) $data->decoded->sub;
        }

        throw new TaskException('Invalid user. Permission failed.', 400);
    }
}

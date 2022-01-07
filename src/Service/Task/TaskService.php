<?php

declare(strict_types=1);

namespace App\Service\Task;

use App\Entity\Task;

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
        $mytask = new Task();
        $mytask->updateName(self::validateTaskName($data->name));
        $description = isset($data->description) ? $data->description : null;
        $mytask->updateDescription($description);
        $status = 0;
        if (isset($data->status)) {
            $status = self::validateTaskStatus($data->status);
        }
        $mytask->updateStatus($status);
        $userId = null;
        if (isset($data->decoded) && isset($data->decoded->sub)) {
            $userId = (int) $data->decoded->sub;
        }
        $mytask->updateUserId($userId);
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
        $task = $this->getTaskFromDb($taskId, (int) $input['decoded']->sub);
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name) && ! isset($data->status)) {
            throw new \App\Exception\Task('Enter the data to update the task.', 400);
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
        $userId = null;
        if (isset($data->decoded) && isset($data->decoded->sub)) {
            $userId = (int) $data->decoded->sub;
        }
        $task->updateUserId($userId);

        return $task;
    }
}

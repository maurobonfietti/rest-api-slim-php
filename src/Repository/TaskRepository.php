<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Task;

final class TaskRepository extends BaseRepository
{
    public function getQueryTasksByPage(): string
    {
        return "
            SELECT *
            FROM `tasks`
            WHERE `userId` = :userId
            AND `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            AND `status` LIKE CONCAT('%', :status, '%')
            ORDER BY `id`
        ";
    }

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
        $params = [
            'userId' => $userId,
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
            'status' => is_null($status) ? '' : $status,
        ];
        $query = $this->getQueryTasksByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('userId', $params['userId']);
        $statement->bindParam('name', $params['name']);
        $statement->bindParam('description', $params['description']);
        $statement->bindParam('status', $params['status']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $params,
            $total
        );
    }

    public function checkAndGetTask(int $taskId, int $userId): Task
    {
        $query = '
            SELECT * FROM `tasks` WHERE `id` = :id AND `userId` = :userId
        ';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('userId', $userId);
        $statement->execute();
        $task = $statement->fetchObject(Task::class);
        if (! $task) {
            throw new \App\Exception\Task('Task not found.', 404);
        }

        return $task;
    }

    /**
     * @return array<string>
     */
    public function getAllTasks(): array
    {
        $query = 'SELECT * FROM `tasks` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(Task $task): Task
    {
        $query = '
            INSERT INTO `tasks`
                (`name`, `description`, `status`, `userId`)
            VALUES
                (:name, :description, :status, :userId)
        ';
        $statement = $this->getDb()->prepare($query);
        $name = $task->getName();
        $desc = $task->getDescription();
        $status = $task->getStatus();
        $userId = $task->getUserId();
        $statement->bindParam('name', $name);
        $statement->bindParam('description', $desc);
        $statement->bindParam('status', $status);
        $statement->bindParam('userId', $userId);
        $statement->execute();

        $taskId = (int) $this->database->lastInsertId();

        return $this->checkAndGetTask($taskId, (int) $userId);
    }

    public function update(Task $task): Task
    {
        $query = '
            UPDATE `tasks`
            SET `name` = :name, `description` = :description, `status` = :status
            WHERE `id` = :id AND `userId` = :userId
        ';
        $statement = $this->getDb()->prepare($query);
        $id = $task->getId();
        $name = $task->getName();
        $desc = $task->getDescription();
        $status = $task->getStatus();
        $userId = $task->getUserId();
        $statement->bindParam('id', $id);
        $statement->bindParam('name', $name);
        $statement->bindParam('description', $desc);
        $statement->bindParam('status', $status);
        $statement->bindParam('userId', $userId);
        $statement->execute();

        return $this->checkAndGetTask((int) $id, (int) $userId);
    }

    public function delete(int $taskId, int $userId): void
    {
        $query = 'DELETE FROM `tasks` WHERE `id` = :id AND `userId` = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('userId', $userId);
        $statement->execute();
    }
}

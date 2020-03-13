<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\TaskException;

class TaskRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function checkAndGetTask(int $taskId, int $userId)
    {
        $query = 'SELECT * FROM `tasks` WHERE `id` = :id AND `userId` = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('userId', $userId);
        $statement->execute();
        $task = $statement->fetchObject();
        if (empty($task)) {
            throw new TaskException('Task not found.', 404);
        }

        return $task;
    }

    public function getAllTasks(): array
    {
        $query = 'SELECT * FROM `tasks` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getAll(int $userId): array
    {
        $query = 'SELECT * FROM `tasks` WHERE `userId` = :userId ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('userId', $userId);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function search($tasksName, int $userId, $status): array
    {
        $query = $this->getSearchTasksQuery($status);
        $name = '%' . $tasksName . '%';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $name);
        $statement->bindParam('userId', $userId);
        if ($status === 0 || $status === 1) {
            $statement->bindParam('status', $status);
        }
        $statement->execute();

        return $statement->fetchAll();
    }

    private function getSearchTasksQuery($status)
    {
        $statusQuery = '';
        if ($status === 0 || $status === 1) {
            $statusQuery = 'AND `status` = :status';
        }

        return "
            SELECT * FROM `tasks`
            WHERE `name` LIKE :name AND `userId` = :userId $statusQuery
            ORDER BY `id`
        ";
    }

    public function create($task)
    {
        $query = '
            INSERT INTO `tasks` (`name`, `description`, `status`, `userId`)
            VALUES (:name, :description, :status, :userId)
        ';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('name', $task->name);
        $statement->bindParam('description', $task->description);
        $statement->bindParam('status', $task->status);
        $statement->bindParam('userId', $task->userId);
        $statement->execute();

        return $this->checkAndGetTask((int) $this->database->lastInsertId(), (int) $task->userId);
    }

    public function update($task)
    {
        $query = '
            UPDATE `tasks`
            SET `name` = :name, `description` = :description, `status` = :status
            WHERE `id` = :id AND `userId` = :userId
        ';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $task->id);
        $statement->bindParam('name', $task->name);
        $statement->bindParam('description', $task->description);
        $statement->bindParam('status', $task->status);
        $statement->bindParam('userId', $task->userId);
        $statement->execute();

        return $this->checkAndGetTask((int) $task->id, (int) $task->userId);
    }

    public function delete(int $taskId, int $userId): string
    {
        $query = 'DELETE FROM `tasks` WHERE `id` = :id AND `userId` = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $taskId);
        $statement->bindParam('userId', $userId);
        $statement->execute();

        return 'The task was deleted.';
    }
}

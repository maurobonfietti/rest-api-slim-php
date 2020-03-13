<?php declare(strict_types=1);

namespace App\Repository;

use App\Exception\UserException;

class UserRepository extends BaseRepository
{
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getUser(int $userId)
    {
        $query = 'SELECT `id`, `name`, `email` FROM `users` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty($user)) {
            throw new UserException('User not found.', 404);
        }

        return $user;
    }

    public function checkUserByEmail(string $email)
    {
        $query = 'SELECT * FROM `users` WHERE `email` = :email';
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty(!$user)) {
            throw new UserException('Email already exists.', 400);
        }
    }

    public function getAll(): array
    {
        $query = 'SELECT `id`, `name`, `email` FROM `users` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function search(string $usersName): array
    {
        $query = 'SELECT `id`, `name`, `email` FROM `users` WHERE `name` LIKE :name ORDER BY `id`';
        $name = '%' . $usersName . '%';
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $name);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            throw new UserException('User name not found.', 404);
        }

        return $users;
    }

    public function loginUser(string $email, string $password)
    {
        $query = 'SELECT * FROM `users` WHERE `email` = :email AND `password` = :password ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->bindParam('password', $password);
        $statement->execute();
        $user = $statement->fetchObject();
        if (empty($user)) {
            throw new UserException('Login failed: Email or password incorrect.', 400);
        }

        return $user;
    }

    public function create($user)
    {
        $query = 'INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)';
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $user->name);
        $statement->bindParam('email', $user->email);
        $statement->bindParam('password', $user->password);
        $statement->execute();

        return $this->getUser((int) $this->database->lastInsertId());
    }

    public function update($user)
    {
        $query = 'UPDATE `users` SET `name` = :name, `email` = :email WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $user->id);
        $statement->bindParam('name', $user->name);
        $statement->bindParam('email', $user->email);
        $statement->execute();

        return $this->getUser((int) $user->id);
    }

    public function delete(int $userId): string
    {
        $query = 'DELETE FROM `users` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();

        return 'The user was deleted.';
    }

    public function deleteUserTasks(int $userId)
    {
        $query = 'DELETE FROM `tasks` WHERE `userId` = :userId';
        $statement = $this->database->prepare($query);
        $statement->bindParam('userId', $userId);
        $statement->execute();
    }
}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

final class UserRepository extends BaseRepository
{
    public function getUser(int $userId): User
    {
        $query = 'SELECT `id`, `name`, `email` FROM `users` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();
        $user = $statement->fetchObject(User::class);
        if (! $user) {
            throw new \App\Exception\User('User not found.', 404);
        }

        return $user;
    }

    public function checkUserByEmail(string $email): void
    {
        $query = 'SELECT * FROM `users` WHERE `email` = :email';
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $user = $statement->fetchObject();
        if ($user) {
            throw new \App\Exception\User('Email already exists.', 400);
        }
    }

    /**
     * @return array<string>
     */
    public function getUsersByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $email
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'email' => is_null($email) ? '' : $email,
        ];
        $query = $this->getQueryUsersByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $params['name']);
        $statement->bindParam('email', $params['email']);
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

    public function getQueryUsersByPage(): string
    {
        return "
            SELECT `id`, `name`, `email`
            FROM `users`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `email` LIKE CONCAT('%', :email, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        $query = 'SELECT `id`, `name`, `email` FROM `users` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function loginUser(string $email, string $password): User
    {
        $query = '
            SELECT *
            FROM `users`
            WHERE `email` = :email AND `password` = :password
            ORDER BY `id`
        ';
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->bindParam('password', $password);
        $statement->execute();
        $user = $statement->fetchObject(User::class);
        if (! $user) {
            throw new \App\Exception\User('Login failed: Email or password incorrect.', 400);
        }

        return $user;
    }

    public function create(User $user): User
    {
        $query = '
            INSERT INTO `users`
                (`name`, `email`, `password`)
            VALUES
                (:name, :email, :password)
        ';
        $statement = $this->database->prepare($query);
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $statement->bindParam('name', $name);
        $statement->bindParam('email', $email);
        $statement->bindParam('password', $password);
        $statement->execute();

        return $this->getUser((int) $this->database->lastInsertId());
    }

    public function update(User $user): User
    {
        $query = '
            UPDATE `users` SET `name` = :name, `email` = :email WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $statement->bindParam('id', $id);
        $statement->bindParam('name', $name);
        $statement->bindParam('email', $email);
        $statement->execute();

        return $this->getUser((int) $id);
    }

    public function delete(int $userId): void
    {
        $query = 'DELETE FROM `users` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();
    }

    public function deleteUserTasks(int $userId): void
    {
        $query = 'DELETE FROM `tasks` WHERE `userId` = :userId';
        $statement = $this->database->prepare($query);
        $statement->bindParam('userId', $userId);
        $statement->execute();
    }
}

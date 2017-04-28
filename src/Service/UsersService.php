<?php

namespace App\Service;

use App\Controller\Base;
use App\Repository\UsersRepository;

/**
 * Users Service.
 */
class UsersService extends Base
{
    /**
     * Constructor of the class.
     *
     * @param object $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Check if the user exists.
     *
     * @param int $userId
     * @return object $user
     * @throws \Exception
     */
    public function checkUser($userId)
    {
        $repo = new UsersRepository;
        $stmt = $this->database->prepare($repo->getUserQuery());
        $stmt->bindParam('id', $userId);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if (!$user) {
            throw new \Exception(self::USER_NOT_FOUND, 404);
        }

        return $user;
    }

    /**
     * Get all users.
     *
     * @return array
     */
    public function getUsers()
    {
        $repository = new UsersRepository;
        $query = $repository->getUsersQuery();
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Get one user by id.
     *
     * @param int $userId
     * @return array
     */
    public function getUser($userId)
    {
        $user = $this->checkUser($userId);

        return $user;
    }

    /**
     * Search users by name.
     *
     * @param string $str
     * @return array
     * @throws \Exception
     */
    public function searchUsers($str)
    {
        $repo = new UsersRepository;
        $stmt = $this->database->prepare($repo->searchUsersQuery());
        $name = '%' . $str . '%';
        $stmt->bindParam('name', $name);
        $stmt->execute();
        $users = $stmt->fetchAll();

        if (!$users) {
            throw new \Exception(self::USER_NAME_NOT_FOUND, 404);
        }

        return $users;
    }

    /**
     * Create a user.
     *
     * @param array $input
     * @return array
     * @throws \Exception
     */
    public function createUser($input)
    {
        $data = $this->validateInput($input);
        $name = $data['name'];
        $email = $data['email'];
        $repository = new UsersRepository;
        $query = $repository->createUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $name);
        $statement->bindParam('email', $email);
        $statement->execute();
        $user = $this->checkUser($this->database->lastInsertId());

        return $user;
    }

    /**
     * Update a user.
     *
     * @param array $input
     * @param int $userId
     * @return array
     * @throws \Exception
     */
    public function updateUser($input, $userId)
    {
        $user = $this->checkUser($userId);
        if (empty($input['name']) && empty($input['email'])) {
            throw new \Exception(self::USER_INFO_REQUIRED, 400);
        }
        $username = isset($input['name']) ? $input['name'] : $user->name;
        $email = $user->email;
        if (isset($input['email'])) {
            $email = $this->validateEmail($input['email']);
        }
        $repository = new UsersRepository;
        $query = $repository->updateUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->bindParam('name', $username);
        $statement->bindParam('email', $email);
        $statement->execute();

        return $this->checkUser($userId);
    }

    /**
     * Delete a user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser($userId)
    {
        $this->checkUser($userId);
        $repository = new UsersRepository;
        $query = $repository->deleteUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();

        return self::USER_DELETED;
    }
}

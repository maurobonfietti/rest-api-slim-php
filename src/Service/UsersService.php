<?php

namespace App\Service;

use App\Controller\Base;
use App\Repository\UsersRepository;

/**
 * Users Service.
 */
class UsersService extends Base
{
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
     * Create user.
     *
     * @param mixed $request
     * @return array
     * @throws Exception
     */
    public function createUser($request)
    {
        $input = $request->getParsedBody();
        if (empty($input['name'])) {
            throw new \Exception(self::USER_NAME_REQUIRED, 400);
        }
        $email = null;
        if (isset($input['email'])) {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new \Exception(self::USER_EMAIL_INVALID, 400);
            }
        }
        $repository = new UsersRepository;
        $query = $repository->createUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $input['name']);
        $statement->bindParam('email', $email);
        $statement->execute();
        $user = $this->checkUser($this->database->lastInsertId());

        return $user;
    }

    /**
     * Update user.
     *
     * @param mixed $request
     * @param int $userId
     * @return array
     * @throws Exception
     */
    public function updateUser($request, $userId)
    {
        $user = $this->checkUser($userId);
        $input = $request->getParsedBody();
        if (empty($input['name']) && empty($input['email'])) {
            throw new \Exception(self::USER_INFO_REQUIRED, 400);
        }
        $username = isset($input['name']) ? $input['name'] : $user->name;
        $email = $user->email;
        if (isset($input['email'])) {
            $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                throw new \Exception(self::USER_EMAIL_INVALID, 400);
            }
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
     * Delete user.
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

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }
}

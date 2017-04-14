<?php

/**
 * Users Service.
 */
class UsersService extends Base
{
    private $database;

    /**
     * Constructor of the class.
     *
     * @param object $database
     */
    public function __construct(PDO $database)
    {
        $this->database = $database;
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
        $user = self::checkUser($this->database, $userId);

        return $user;
    }

    /**
     * Search users by name.
     *
     * @param string $usersStr
     * @return array
     * @throws Exception
     */
    public function searchUsers($usersStr)
    {
        $repository = new UsersRepository;
        $query = $repository->searchUsersQuery();
        $statement = $this->database->prepare($query);
        $name = '%'.$usersStr.'%';
        $statement->bindParam('name', $name);
        $statement->execute();
        $users = $statement->fetchAll();
        if (!$users) {
            throw new Exception(self::USER_NAME_NOT_FOUND, 404);
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
            throw new Exception(self::USER_NAME_REQUIRED, 400);
        }
        $repository = new UsersRepository;
        $query = $repository->createUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $input['name']);
        $statement->execute();
        $user = self::checkUser($this->database, $this->database->lastInsertId());

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
        $user = self::checkUser($this->database, $userId);
        $input = $request->getParsedBody();
        if (empty($input['name']) && empty($input['email'])) {
            throw new Exception(self::USER_INFO_REQUIRED, 400);
        }
        $username = isset($input['name']) ? $input['name'] : $user->name;
        $email = isset($input['email']) ? $input['email'] : $user->email;
        $repository = new UsersRepository;
        $query = $repository->updateUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->bindParam('name', $username);
        $statement->bindParam('email', $email);
        $statement->execute();

        return self::checkUser($this->database, $userId);
    }

    /**
     * Delete user.
     *
     * @param int $userId
     * @return array
     */
    public function deleteUser($userId)
    {
        self::checkUser($this->database, $userId);
        $repository = new UsersRepository;
        $query = $repository->deleteUserQuery();
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $userId);
        $statement->execute();

        return self::USER_DELETED;
    }
}

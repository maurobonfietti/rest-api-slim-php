<?php

namespace Tests\integration;

class UserServiceTest extends BaseTestCase
{
    private static $id;

    public function testGetUser()
    {
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));
        $pdo = new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $user = $userService->getUser(1);
        $this->assertStringContainsString('Juan', $user->name);
    }

    public function testCreateUser()
    {
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));
        $pdo = new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $input = ['name' => 'Eze', 'email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->createUser($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testCreateUserWithoutName()
    {
        $this->expectException(\App\Exception\UserException::class);
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));
        $pdo = new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $input = ['email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->createUser($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testDeleteUser()
    {
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));
        $pdo = new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $userId = self::$id;
        $user = $userService->deleteUser($userId);
        $this->assertStringContainsString('The user was deleted.', $user);
    }
}

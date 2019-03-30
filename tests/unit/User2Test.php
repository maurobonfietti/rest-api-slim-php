<?php

namespace Tests\api;

class User2Test extends BaseTestCase
{
    private static $id;

    public function testGetOneUser()
    {
//        var_dump('asddssss'); exit;
        $database = sprintf('mysql:host=%s;dbname=%s', 'localhost', 'rest_api_slim_php');
        $pdo = new \PDO($database, 'root', '');
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $user = $userService->getUser(1);
        $this->assertStringContainsString('Juan', $user->name);
    }

    public function testCreateUser()
    {
        $database = sprintf('mysql:host=%s;dbname=%s', 'localhost', 'rest_api_slim_php');
        $pdo = new \PDO($database, 'root', '');
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $input = ['name' => 'Eze', 'email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->createUser($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testDeleteUser()
    {
        $database = sprintf('mysql:host=%s;dbname=%s', 'localhost', 'rest_api_slim_php');
        $pdo = new \PDO($database, 'root', '');
        $userRepository = new \App\Repository\UserRepository($pdo);
        $userService = new \App\Service\UserService($userRepository);
        $userId = self::$id;
        $user = $userService->deleteUser($userId);
        $this->assertStringContainsString('The user was deleted.', $user);
    }
}

<?php

declare(strict_types=1);

namespace Tests\unit\Service;

use Tests\integration\BaseTestCase;

class UserServiceTest extends BaseTestCase
{
    /**
     * @var int
     */
    private static $id;

    private function getDatabase(): \PDO
    {
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));

        return new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    }

    public function testGetUser(): void
    {
        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\User\UserService($userRepository, $redisService);
        $user = $userService->getOne(1);
        $this->assertStringContainsString('Juan', $user->name);
    }

    public function testCreateUser(): void
    {
        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\User\UserService($userRepository, $redisService);
        $input = ['name' => 'Eze', 'email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->create($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testCreateUserWithoutNameExpectError(): void
    {
        $this->expectException(\App\Exception\User::class);

        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\User\UserService($userRepository, $redisService);
        $input = ['email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->create($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testDeleteUser(): void
    {
        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\User\UserService($userRepository, $redisService);
        $userId = self::$id;
        $user = $userService->delete((int) $userId);
        $this->assertStringContainsString('The user was deleted.', $user);
    }
}

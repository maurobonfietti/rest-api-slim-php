<?php declare(strict_types=1);

namespace Tests\integration;

class UserServiceTest extends BaseTestCase
{
    private static $id;

    private function getDatabase()
    {
        $database = sprintf('mysql:host=%s;dbname=%s', getenv('DB_HOSTNAME'), getenv('DB_DATABASE'));

        return new \PDO($database, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    }

    public function testGetUser()
    {
        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\UserService($userRepository, $redisService);
        $user = $userService->getUser(1);
        $this->assertStringContainsString('Juan', $user->name);
    }

    public function testCreateUser()
    {
        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\UserService($userRepository, $redisService);
        $input = ['name' => 'Eze', 'email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->createUser($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testCreateUserWithoutNameExpectError()
    {
        $this->expectException(\App\Exception\UserException::class);

        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\UserService($userRepository, $redisService);
        $input = ['email' => 'eze@gmail.com', 'password' => 'AnyPass1000'];
        $user = $userService->createUser($input);
        self::$id = $user->id;
        $this->assertStringContainsString('Eze', $user->name);
    }

    public function testDeleteUser()
    {
        $userRepository = new \App\Repository\UserRepository($this->getDatabase());
        $redisService = new \App\Service\RedisService(new \Predis\Client());
        $userService = new \App\Service\UserService($userRepository, $redisService);
        $userId = self::$id;
        $user = $userService->deleteUser((int) $userId);
        $this->assertStringContainsString('The user was deleted.', $user);
    }
}

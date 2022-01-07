<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'user:%s';

    public function __construct(
        protected UserRepository $userRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateUserName(string $name): string
    {
        if (! v::alnum('ÁÉÍÓÚÑáéíóúñ.')->length(1, 100)->validate($name)) {
            throw new \App\Exception\User('Invalid name.', 400);
        }

        return $name;
    }

    protected static function validateEmail(string $emailValue): string
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (! v::email()->validate($email)) {
            throw new \App\Exception\User('Invalid email', 400);
        }

        return (string) $email;
    }

    protected function getUserFromCache(int $userId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $userId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $data = $this->redisService->get($key);
            $user = json_decode((string) json_encode($data), false);
        } else {
            $user = $this->getUserFromDb($userId)->toJson();
            $this->redisService->setex($key, $user);
        }

        return $user;
    }

    protected function getUserFromDb(int $userId): User
    {
        return $this->userRepository->getUser($userId);
    }

    protected function saveInCache(int $id, object $user): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $user);
    }

    protected function deleteFromCache(int $userId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $userId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}

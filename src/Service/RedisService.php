<?php

declare(strict_types=1);

namespace App\Service;

use Predis\Client;

final class RedisService
{
    public const PROJECT_NAME = 'rest-api-slim-php';

    private Client $redis;

    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    public function generateKey(string $value): string
    {
        return self::PROJECT_NAME . ':' . $value;
    }

    public function exists(string $key): int
    {
        return $this->redis->exists($key);
    }

    public function get(string $key): object
    {
        return json_decode((string) $this->redis->get($key));
    }

    public function set(string $key, object $value): void
    {
        $this->redis->set($key, json_encode($value));
    }

    public function setex(string $key, object $value, int $ttl = 3600): void
    {
        $this->redis->setex($key, $ttl, json_encode($value));
    }

    public function del(array $keys): void
    {
        $this->redis->del($keys);
    }
}

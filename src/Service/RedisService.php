<?php

declare(strict_types=1);

namespace App\Service;

final class RedisService
{
    public const PROJECT_NAME = 'rest-api-slim-php';

    /**
     * @var \Predis\Client
     */
    private $redis;

    public function __construct(\Predis\Client $redis)
    {
        $this->redis = $redis;
    }

    public function generateKey(string $value)
    {
        return self::PROJECT_NAME . ':' . $value;
    }

    public function exists(string $key)
    {
        return $this->redis->exists($key);
    }

    public function get(string $key)
    {
        return json_decode($this->redis->get($key), true);
    }

    public function set($key, $value): void
    {
        $this->redis->set($key, json_encode($value));
    }

    public function setex($key, $value, int $ttl = 3600): void
    {
        $this->redis->setex($key, $ttl, json_encode($value));
    }

    public function del(string $key): void
    {
        $this->redis->del($key);
    }
}

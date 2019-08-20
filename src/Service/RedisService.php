<?php declare(strict_types=1);

namespace App\Service;

class RedisService
{
    const PROJECT_NAME = 'rest-api-slim-php';

    protected $redis;

    public function __construct($redis)
    {
        $this->redis = $redis;
    }

    public function generateKey($value)
    {
        return self::PROJECT_NAME . ':' . $value;
    }

    public function exists($key)
    {
        return $this->redis->exists($key);
    }

    public function get($key)
    {
        return json_decode($this->redis->get($key), true);
    }

    public function set($key, $value)
    {
        $this->redis->set($key, json_encode($value));
    }

    public function setex($key, $value, $ttl = 3600)
    {
        $this->redis->setex($key, $ttl, json_encode($value));
    }

    public function del($key)
    {
        $this->redis->del($key);
    }
}

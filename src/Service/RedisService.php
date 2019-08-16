<?php declare(strict_types=1);

namespace App\Service;

class RedisService
{
    const PROJECT_NAME = 'rest-api-slim-php';

    protected $cache;

    public function __construct($cache)
    {
        $this->cache = $cache;
    }

    private function generateKey($value)
    {
        return self::PROJECT_NAME.':'.$value;
    }

    public function exists($key)
    {
        $key = $this->generateKey($key);

        return $this->cache->exists($key);
    }

    public function get($key)
    {
        $key = $this->generateKey($key);

        return json_decode($this->cache->get($key), true);
    }

    public function setex($key, $value, $ttl = 3600)
    {
        $key = $this->generateKey($key);
        $this->cache->setex($key, $ttl, json_encode($value));
    }

    public function set($key, $value)
    {
        $key = $this->generateKey($key);
        $this->cache->set($key, json_encode($value));
    }

    public function delete($key)
    {
        $key = $this->generateKey($key);
        $this->cache->delete($key);
    }
}

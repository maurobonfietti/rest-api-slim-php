<?php

declare(strict_types=1);

namespace App\Service;

abstract class BaseService
{
    protected const DEFAULT_PER_PAGE_PAGINATION = 5;

    protected static function isRedisEnabled(): bool
    {
        return filter_var($_SERVER['REDIS_ENABLED'], FILTER_VALIDATE_BOOLEAN);
    }
}

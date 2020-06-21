<?php

declare(strict_types=1);

use App\Handler\ApiError;
use App\Service\RedisService;

$container['db'] = static function (): PDO {
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s',
        getenv('DB_HOSTNAME'),
        getenv('DB_DATABASE')
    );
    $pdo = new PDO($dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};

$container['errorHandler'] = static function (): ApiError {
    return new ApiError();
};

$container['redis_service'] = static function (): RedisService {
    return new RedisService(new \Predis\Client(getenv('REDIS_URL')));
};

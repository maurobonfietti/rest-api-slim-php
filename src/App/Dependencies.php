<?php

declare(strict_types=1);

use App\Handler\ApiError;
use App\Service\RedisService;
use Psr\Container\ContainerInterface;

$container['db'] = static function (ContainerInterface $container): PDO {
    $db = $container->get('settings')['db'];
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', $db['hostname'], $db['database']);
    $pdo = new PDO($dsn, $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};

$container['errorHandler'] = static function (): ApiError {
    return new ApiError();
};

$container['redis_service'] = static function ($container): RedisService {
    $redis = $container->get('settings')['redis'];

    return new RedisService(new \Predis\Client($redis['url']));
};

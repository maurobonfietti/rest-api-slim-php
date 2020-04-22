<?php

declare(strict_types=1);

use App\Handler\ApiError;
use App\Service\RedisService;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['db'] = static function (ContainerInterface $c): PDO {
    $db = $c->get('settings')['db'];
    $pdo = new PDO(
        sprintf('mysql:host=%s;dbname=%s', $db['hostname'], $db['database']),
        $db['username'],
        $db['password']
    );
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

<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use App\Handler\ApiError;
use App\Service\RedisService;

$container = $app->getContainer();

$container['db'] = function (ContainerInterface $c): PDO {
    $db = $c->get('settings')['db'];
    $database = sprintf('mysql:host=%s;dbname=%s', $db['hostname'], $db['database']);
    $pdo = new PDO($database, $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $pdo;
};

$container['errorHandler'] = function (): ApiError {
    return new ApiError;
};

$container['redis_service'] = function (): RedisService {
    return new RedisService(new \Predis\Client(getenv('REDIS_URL')));
};

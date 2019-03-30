<?php

use Psr\Container\ContainerInterface;

$container = $app->getContainer();

/**
 * PDO database library: Creates a PDO instance representing a connection to a database.
 *
 * @param ContainerInterface $c
 * @return PDO
 */
$container['db'] = function (ContainerInterface $c) {
    $db = $c->get('settings')['db'];
    $database = sprintf('mysql:host=%s;dbname=%s', $db['hostname'], $db['database']);
    $pdo = new PDO($database, $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};

/**
 * Predis Client: Client class used for connecting and executing commands on Redis.
 *
 * @return \Predis\Client
 */
$container['redis'] = function () {
    return new \Predis\Client(getenv('REDIS_URL'));
};

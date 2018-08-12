<?php

use Monolog\Logger;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

/**
 * PDO database library
 *
 * @param ContainerInterface $c
 * @return PDO
 */
$container['db'] = function(ContainerInterface $c) {
    $db = $c->get('settings')['db'];
    $database = sprintf('mysql:host=%s;dbname=%s', $db['hostname'], $db['database']);
    $pdo = new PDO($database, $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};

/**
 * Logger
 *
 * @param ContainerInterface $c
 * @return bool|Logger
 */
$container['logger'] = function(ContainerInterface $c) {
    $settings = $c->get('settings')['logger'];
    if ($settings['enabled'] === false) {
        return false;
    }
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

$container['redis'] = function() {
    return new \Predis\Client();
};

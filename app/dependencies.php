<?php

use App\Service\UserService;
use App\Service\TaskService;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

/**
 * PDO database library
 *
 * @param ContainerInterface $c
 * @return PDO
 */
$container['db'] = function (ContainerInterface $c) {
    $db = $c->get('settings')['db'];
    $database = sprintf('mysql:host=%s;dbname=%s', $db['host'], $db['dbname']);
    $pdo = new PDO($database, $db['user'], $db['pass']);
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
$container['logger'] = function (ContainerInterface $c) {
    $settings = $c->get('settings')['logger'];
    if ($settings['enabled'] === false) {
        return false;
    }
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler(
        $settings['path'],
        $settings['level']
    ));

    return $logger;
};

/**
 * @param ContainerInterface $c
 * @return UserService
 */
$container['user_service'] = function ($container) {
    return new UserService($container->get('user_repository'));
};

/**
 * @param ContainerInterface $c
 * @return UserRepository
 */
$container['user_repository'] = function ($container) {
    return new UserRepository($container->get('db'));
};

/**
 * @param ContainerInterface $c
 * @return TaskService
 */
$container['task_service'] = function ($container) {
    return new TaskService($container->get('task_repository'));
};

/**
 * @param ContainerInterface $c
 * @return TaskRepository
 */
$container['task_repository'] = function ($container) {
    return new TaskRepository($container->get('db'));
};

<?php

use App\Service\UserService;
use App\Service\TaskService;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;

$container = $app->getContainer();

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

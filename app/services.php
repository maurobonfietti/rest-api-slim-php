<?php

use App\Service\UserService;
use App\Service\TaskService;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use App\Handlers\ApiError;

$container = $app->getContainer();

/**
 * @return ApiError
 */
$container["errorHandler"] = function() {
    return new ApiError;
};

/**
 * @param ContainerInterface $container
 * @return UserService
 */
$container['user_service'] = function($container) {
    return new UserService($container->get('user_repository'));
};

/**
 * @param ContainerInterface $container
 * @return UserRepository
 */
$container['user_repository'] = function($container) {
    return new UserRepository($container->get('db'));
};

/**
 * @param ContainerInterface $container
 * @return TaskService
 */
$container['task_service'] = function($container) {
    return new TaskService($container->get('task_repository'));
};

/**
 * @param ContainerInterface $container
 * @return TaskRepository
 */
$container['task_repository'] = function($container) {
    return new TaskRepository($container->get('db'));
};

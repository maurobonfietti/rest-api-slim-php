<?php

use App\Service\UserService;
use App\Service\TaskService;
use App\Service\NoteService;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use App\Repository\NoteRepository;
use App\Handler\ApiError;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['errorHandler'] = function (): ApiError {
    return new ApiError;
};

$container['user_service'] = function (ContainerInterface $container): UserService {
    return new UserService($container->get('user_repository'));
};

$container['user_repository'] = function (ContainerInterface $container): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['task_service'] = function (ContainerInterface $container): TaskService {
    return new TaskService($container->get('task_repository'));
};

$container['task_repository'] = function (ContainerInterface $container): TaskRepository {
    return new TaskRepository($container->get('db'));
};

$container['note_service'] = function (ContainerInterface $container): NoteService {
    return new NoteService($container->get('note_repository'));
};

$container['note_repository'] = function (ContainerInterface $container): NoteRepository {
    return new NoteRepository($container->get('db'));
};

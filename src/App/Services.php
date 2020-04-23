<?php

declare(strict_types=1);

use App\Service\Note\NoteService;
use App\Service\TaskService;
use App\Service\UserService;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['user_service'] = static function (ContainerInterface $container): UserService {
    return new UserService($container->get('user_repository'), $container->get('redis_service'));
};

$container['task_service'] = static function (ContainerInterface $container): TaskService {
    return new TaskService($container->get('task_repository'), $container->get('redis_service'));
};

$container['note_service'] = static function (ContainerInterface $container): NoteService {
    return new NoteService($container->get('note_repository'), $container->get('redis_service'));
};

<?php

declare(strict_types=1);

use App\Service\Note\NoteService;
use App\Service\Task\TaskService;
use App\Service\User\UserService;
use Psr\Container\ContainerInterface;

$container = $app->getContainer();

$container['user_service'] = static fn(ContainerInterface $container): UserService => new UserService($container->get('user_repository'), $container->get('redis_service'));

$container['task_service'] = static fn(ContainerInterface $container): TaskService => new TaskService($container->get('task_repository'), $container->get('redis_service'));

$container['note_service'] = static fn(ContainerInterface $container): NoteService => new NoteService($container->get('note_repository'), $container->get('redis_service'));

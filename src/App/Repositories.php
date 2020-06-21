<?php

declare(strict_types=1);

use App\Repository\NoteRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Psr\Container\ContainerInterface;

$container['user_repository'] = static function (
    ContainerInterface $container
): UserRepository {
    return new UserRepository($container->get('db'));
};

$container['task_repository'] = static function (
    ContainerInterface $container
): TaskRepository {
    return new TaskRepository($container->get('db'));
};

$container['note_repository'] = static function (
    ContainerInterface $container
): NoteRepository {
    return new NoteRepository($container->get('db'));
};

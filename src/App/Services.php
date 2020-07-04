<?php

declare(strict_types=1);

use App\Service\Note;
use App\Service\Task\TaskService;
use App\Service\User\UserService;
use Psr\Container\ContainerInterface;

$container['user_service'] = static function (
    ContainerInterface $container
): UserService {
    return new UserService(
        $container->get('user_repository'),
        $container->get('redis_service')
    );
};

$container['task_service'] = static function (
    ContainerInterface $container
): TaskService {
    return new TaskService(
        $container->get('task_repository'),
        $container->get('redis_service')
    );
};

$container['find_note_service'] = static function (
    ContainerInterface $container
): Note\Find {
    return new Note\Find(
        $container->get('note_repository'),
        $container->get('redis_service')
    );
};

$container['create_note_service'] = static function (
    ContainerInterface $container
): Note\Create {
    return new Note\Create(
        $container->get('note_repository'),
        $container->get('redis_service')
    );
};

$container['update_note_service'] = static function (
    ContainerInterface $container
): Note\Update {
    return new Note\Update(
        $container->get('note_repository'),
        $container->get('redis_service')
    );
};

$container['delete_note_service'] = static function (
    ContainerInterface $container
): Note\Delete {
    return new Note\Delete(
        $container->get('note_repository'),
        $container->get('redis_service')
    );
};

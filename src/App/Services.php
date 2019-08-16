<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use App\Service\UserService;
use App\Service\TaskService;
use App\Service\NoteService;
use App\Service\RedisService;

$container = $app->getContainer();

$container['user_service'] = function (ContainerInterface $container): UserService {
    return new UserService($container->get('user_repository'));
};

$container['task_service'] = function (ContainerInterface $container): TaskService {
    return new TaskService($container->get('task_repository'));
};

$container['note_service'] = function (ContainerInterface $container): NoteService {
    return new NoteService(
        $container->get('note_repository'),
        $container->get('redis_service')
    );
};

$container['redis_service'] = function ($container) {
    return new RedisService($container->get('redis'));
};

$container['redis'] = function (): \Predis\Client {
    return new \Predis\Client(getenv('REDIS_URL'));
};

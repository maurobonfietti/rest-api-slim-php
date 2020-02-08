<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use App\Service\UserService;
use App\Service\TaskService;

use App\Service\Note\Create;
use App\Service\Note\Delete;
use App\Service\Note\GetAll;
use App\Service\Note\GetOne;
use App\Service\Note\Search;
use App\Service\Note\Update;

$container = $app->getContainer();

$container['user_service'] = function (ContainerInterface $container): UserService {
    return new UserService($container->get('user_repository'), $container->get('redis_service'));
};

$container['task_service'] = function (ContainerInterface $container): TaskService {
    return new TaskService($container->get('task_repository'), $container->get('redis_service'));
};

$container['create_note_service'] = function (ContainerInterface $container): Create {
    return new Create($container->get('note_repository'), $container->get('redis_service'));
};

$container['delete_note_service'] = function (ContainerInterface $container): Delete {
    return new Delete($container->get('note_repository'), $container->get('redis_service'));
};

$container['get_all_note_service'] = function (ContainerInterface $container): GetAll {
    return new GetAll($container->get('note_repository'), $container->get('redis_service'));
};

$container['get_one_note_service'] = function (ContainerInterface $container): GetOne {
    return new GetOne($container->get('note_repository'), $container->get('redis_service'));
};

$container['search_note_service'] = function (ContainerInterface $container): Search {
    return new Search($container->get('note_repository'), $container->get('redis_service'));
};

$container['update_note_service'] = function (ContainerInterface $container): Update {
    return new Update($container->get('note_repository'), $container->get('redis_service'));
};

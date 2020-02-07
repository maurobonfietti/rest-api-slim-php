<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use App\Service\UserService;
use App\Service\TaskService;

use App\Service\Note\CreateNoteService;
use App\Service\Note\DeleteNoteService;
use App\Service\Note\GetAllNoteService;
use App\Service\Note\GetOneNoteService;
use App\Service\Note\SearchNoteService;
use App\Service\Note\UpdateNoteService;

$container = $app->getContainer();

$container['user_service'] = function (ContainerInterface $container): UserService {
    return new UserService($container->get('user_repository'), $container->get('redis_service'));
};

$container['task_service'] = function (ContainerInterface $container): TaskService {
    return new TaskService($container->get('task_repository'), $container->get('redis_service'));
};

$container['create_note_service'] = function (ContainerInterface $container): CreateNoteService {
    return new CreateNoteService($container->get('note_repository'), $container->get('redis_service'));
};

$container['delete_note_service'] = function (ContainerInterface $container): DeleteNoteService {
    return new DeleteNoteService($container->get('note_repository'), $container->get('redis_service'));
};

$container['get_all_note_service'] = function (ContainerInterface $container): GetAllNoteService {
    return new GetAllNoteService($container->get('note_repository'), $container->get('redis_service'));
};

$container['get_one_note_service'] = function (ContainerInterface $container): GetOneNoteService {
    return new GetOneNoteService($container->get('note_repository'), $container->get('redis_service'));
};

$container['search_note_service'] = function (ContainerInterface $container): SearchNoteService {
    return new SearchNoteService($container->get('note_repository'), $container->get('redis_service'));
};

$container['update_note_service'] = function (ContainerInterface $container): UpdateNoteService {
    return new UpdateNoteService($container->get('note_repository'), $container->get('redis_service'));
};

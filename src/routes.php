<?php

$app->get('/', 'App\Controller\DefaultController:getHelp');

$app->get('/version', 'App\Controller\DefaultController:getVersion');

$app->group('/tasks', function () use ($app) {
    $app->get('', 'App\Controller\TasksController:getTasks');
    $app->get('/[{id}]', 'App\Controller\TasksController:getTask');
    $app->get('/search/[{query}]', 'App\Controller\TasksController:searchTasks');
    $app->post('', 'App\Controller\TasksController:createTask');
    $app->put('/[{id}]', 'App\Controller\TasksController:updateTask');
    $app->delete('/[{id}]', 'App\Controller\TasksController:deleteTask');
});

$app->group('/users', function () use ($app) {
    $app->get('', 'App\Controller\UsersController:getUsers');
    $app->get('/[{id}]', 'App\Controller\UsersController:getUser');
    $app->get('/search/[{query}]', 'App\Controller\UsersController:searchUsers');
    $app->post('', 'App\Controller\UsersController:createUser');
    $app->put('/[{id}]', 'App\Controller\UsersController:updateUser');
    $app->delete('/[{id}]', 'App\Controller\UsersController:deleteUser');
});

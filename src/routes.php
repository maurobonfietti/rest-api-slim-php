<?php

$app->get('/', 'App\Controller\DefaultController:getHelp');

$app->get('/version', 'App\Controller\DefaultController:getVersion');

$app->group('/tasks', function () use ($app) {
    $app->get('', 'App\Controller\TaskController:getTasks');
    $app->get('/[{id}]', 'App\Controller\TaskController:getTask');
    $app->get('/search/[{query}]', 'App\Controller\TaskController:searchTasks');
    $app->post('', 'App\Controller\TaskController:createTask');
    $app->put('/[{id}]', 'App\Controller\TaskController:updateTask');
    $app->delete('/[{id}]', 'App\Controller\TaskController:deleteTask');
});

$app->group('/users', function () use ($app) {
    $app->get('', 'App\Controller\UserController:getUsers');
    $app->get('/[{id}]', 'App\Controller\UserController:getUser');
    $app->get('/search/[{query}]', 'App\Controller\UserController:searchUsers');
    $app->post('', 'App\Controller\UserController:createUser');
    $app->put('/[{id}]', 'App\Controller\UserController:updateUser');
    $app->delete('/[{id}]', 'App\Controller\UserController:deleteUser');
});

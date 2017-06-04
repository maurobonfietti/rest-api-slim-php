<?php

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/version', 'App\Controller\DefaultController:getVersion');
$app->get('/status', 'App\Controller\DefaultController:getStatus');

$app->group('/api/v1', function () use ($app) {
    $app->group('/tasks', function () use ($app) {
        $app->get('', 'App\Controller\Task\GetAllTasks:getTasks');
        $app->get('/[{id}]', 'App\Controller\Task\GetOneTask:getTask');
        $app->get('/search/[{query}]', 'App\Controller\Task\SearchTasks:searchTasks');
        $app->post('', 'App\Controller\Task\CreateTask:createTask');
        $app->put('/[{id}]', 'App\Controller\Task\UpdateTask:updateTask');
        $app->delete('/[{id}]', 'App\Controller\Task\DeleteTask:deleteTask');
    });
    $app->group('/users', function () use ($app) {
        $app->get('', 'App\Controller\User\GetAllUsers:getUsers');
        $app->get('/[{id}]', 'App\Controller\User\GetOneUser:getUser');
        $app->get('/search/[{query}]', 'App\Controller\User\SearchUsers:searchUsers');
        $app->post('', 'App\Controller\User\CreateUser:createUser');
        $app->put('/[{id}]', 'App\Controller\User\UpdateUser:updateUser');
        $app->delete('/[{id}]', 'App\Controller\User\DeleteUser:deleteUser');
    });
});

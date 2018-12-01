<?php

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/status', 'App\Controller\DefaultController:getStatus');

$app->group('/api/v1', function () use ($app) {
    $app->group('/tasks', function () use ($app) {
        $app->get('', 'App\Controller\Task\GetAllTasks');
        $app->get('/[{id}]', 'App\Controller\Task\GetOneTask');
        $app->get('/search/[{query}]', 'App\Controller\Task\SearchTasks');
        $app->post('', 'App\Controller\Task\CreateTask');
        $app->put('/[{id}]', 'App\Controller\Task\UpdateTask');
        $app->delete('/[{id}]', 'App\Controller\Task\DeleteTask');
    });
    $app->group('/users', function () use ($app) {
        $app->get('', 'App\Controller\User\GetAllUsers');
        $app->get('/[{id}]', 'App\Controller\User\GetOneUser');
        $app->get('/search/[{query}]', 'App\Controller\User\SearchUsers');
        $app->post('', 'App\Controller\User\CreateUser');
        $app->put('/[{id}]', 'App\Controller\User\UpdateUser');
        $app->delete('/[{id}]', 'App\Controller\User\DeleteUser');
    });
    $app->group('/notes', function () use ($app) {
        $app->get('', 'App\Controller\Note\GetAllNotes');
        $app->get('/[{id}]', 'App\Controller\Note\GetOneNote');
        $app->get('/search/[{query}]', 'App\Controller\Note\SearchNotes');
        $app->post('', 'App\Controller\Note\CreateNote');
        $app->put('/[{id}]', 'App\Controller\Note\UpdateNote');
        $app->delete('/[{id}]', 'App\Controller\Note\DeleteNote');
    });
});

<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/status', 'App\Controller\DefaultController:getStatus');
$app->post('/login', \App\Controller\User\Login::class);

$app->group('/api/v1', function () use ($app) {
    $app->group('/tasks', function () use ($app) {
        $app->get('', \App\Controller\Task\GetAll::class);
        $app->get('/[{id}]', \App\Controller\Task\GetOne::class);
        $app->get('/search/[{query}]', \App\Controller\Task\Search::class);
        $app->post('', \App\Controller\Task\Create::class);
        $app->put('/[{id}]', \App\Controller\Task\Update::class);
        $app->delete('/[{id}]', \App\Controller\Task\Delete::class);
    })->add(new App\Middleware\Auth());
    $app->group('/users', function () use ($app) {
        $app->get('', \App\Controller\User\GetAll::class)->add(new App\Middleware\Auth());
        $app->get('/[{id}]', \App\Controller\User\GetOne::class)->add(new App\Middleware\Auth());
        $app->get('/search/[{query}]', \App\Controller\User\Search::class)->add(new App\Middleware\Auth());
        $app->post('', \App\Controller\User\Create::class);
        $app->put('/[{id}]', \App\Controller\User\Update::class)->add(new App\Middleware\Auth());
        $app->delete('/[{id}]', \App\Controller\User\Delete::class)->add(new App\Middleware\Auth());
    });
    $app->group('/notes', function () use ($app) {
        $app->get('', \App\Controller\Note\GetAll::class);
        $app->get('/[{id}]', \App\Controller\Note\GetOne::class);
        $app->get('/search/[{query}]', \App\Controller\Note\Search::class);
        $app->post('', \App\Controller\Note\Create::class);
        $app->put('/[{id}]', \App\Controller\Note\Update::class);
        $app->delete('/[{id}]', \App\Controller\Note\Delete::class);
    });
});

<?php

declare(strict_types=1);

use App\Middleware\Auth;

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/status', 'App\Controller\DefaultController:getStatus');
$app->post('/login', \App\Controller\User\Login::class);

$app->group('/api/v1', function () use ($app): void {
    $app->group('/tasks', function () use ($app): void {
        $app->get('', \App\Controller\Task\GetAll::class);
        $app->get('/[{id}]', \App\Controller\Task\GetOne::class);
        $app->get('/search/[{query}]', \App\Controller\Task\Search::class);
        $app->post('', \App\Controller\Task\Create::class);
        $app->put('/[{id}]', \App\Controller\Task\Update::class);
        $app->delete('/[{id}]', \App\Controller\Task\Delete::class);
    })->add(new Auth());

    $app->group('/users', function () use ($app): void {
        $app->get('', \App\Controller\User\GetAll::class)->add(new Auth());
        $app->get('/[{id}]', \App\Controller\User\GetOne::class)->add(new Auth());
        $app->get('/search/[{query}]', \App\Controller\User\Search::class)->add(new Auth());
        $app->post('', \App\Controller\User\Create::class);
        $app->put('/[{id}]', \App\Controller\User\Update::class)->add(new Auth());
        $app->delete('/[{id}]', \App\Controller\User\Delete::class)->add(new Auth());
    });

    $app->group('/notes', function () use ($app): void {
        $app->get('', \App\Controller\Note\GetAll::class);
        $app->get('/[{id}]', \App\Controller\Note\GetOne::class);
        $app->get('/search/[{query}]', \App\Controller\Note\Search::class);
        $app->post('', \App\Controller\Note\Create::class);
        $app->put('/[{id}]', \App\Controller\Note\Update::class);
        $app->delete('/[{id}]', \App\Controller\Note\Delete::class);
    });
});

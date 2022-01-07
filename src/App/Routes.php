<?php

declare(strict_types=1);

use App\Controller\Note;
use App\Controller\Task;
use App\Controller\User;
use App\Middleware\Auth;

return function ($app) {
    $app->get('/', 'App\Controller\DefaultController:getHelp');
    $app->get('/status', 'App\Controller\DefaultController:getStatus');
    $app->post('/login', \App\Controller\User\Login::class);

    $app->group('/api/v1', function () use ($app): void {
        $app->group('/tasks', function () use ($app): void {
            $app->get('', Task\GetAll::class);
            $app->post('', Task\Create::class);
            $app->get('/{id}', Task\GetOne::class);
            $app->put('/{id}', Task\Update::class);
            $app->delete('/{id}', Task\Delete::class);
        })->add(new Auth());

        $app->group('/users', function () use ($app): void {
            $app->get('', User\GetAll::class)->add(new Auth());
            $app->post('', User\Create::class);
            $app->get('/{id}', User\GetOne::class)->add(new Auth());
            $app->put('/{id}', User\Update::class)->add(new Auth());
            $app->delete('/{id}', User\Delete::class)->add(new Auth());
        });

        $app->group('/notes', function () use ($app): void {
            $app->get('', Note\GetAll::class);
            $app->post('', Note\Create::class);
            $app->get('/{id}', Note\GetOne::class);
            $app->put('/{id}', Note\Update::class);
            $app->delete('/{id}', Note\Delete::class);
        });
    });

    return $app;
};

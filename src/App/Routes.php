<?php declare(strict_types=1);

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/status', 'App\Controller\DefaultController:getStatus');
$app->post('/login', 'App\Controller\User\Login');

$app->group('/api/v1', function () use ($app) {
    $app->group('/tasks', function () use ($app) {
        $app->get('', 'App\Controller\Task\GetAll');
        $app->get('/[{id}]', 'App\Controller\Task\GetOne');
        $app->get('/search/[{query}]', 'App\Controller\Task\Search');
        $app->post('', 'App\Controller\Task\Create');
        $app->put('/[{id}]', 'App\Controller\Task\Update');
        $app->delete('/[{id}]', 'App\Controller\Task\Delete');
    })->add(new App\Middleware\AuthMiddleware($app));
    $app->group('/users', function () use ($app) {
        $app->get('', 'App\Controller\User\GetAll')->add(new App\Middleware\AuthMiddleware($app));
        $app->get('/[{id}]', 'App\Controller\User\GetOne')->add(new App\Middleware\AuthMiddleware($app));
        $app->get('/search/[{query}]', 'App\Controller\User\Search')->add(new App\Middleware\AuthMiddleware($app));
        $app->post('', 'App\Controller\User\Create');
        $app->put('/[{id}]', 'App\Controller\User\Update')->add(new App\Middleware\AuthMiddleware($app));
        $app->delete('/[{id}]', 'App\Controller\User\Delete')->add(new App\Middleware\AuthMiddleware($app));
    });
    $app->group('/notes', function () use ($app) {
        $app->get('', 'App\Controller\Note\GetAll');
        $app->get('/[{id}]', 'App\Controller\Note\GetOne');
        $app->get('/search/[{query}]', 'App\Controller\Note\Search');
        $app->post('', 'App\Controller\Note\Create');
        $app->put('/[{id}]', 'App\Controller\Note\Update');
        $app->delete('/[{id}]', 'App\Controller\Note\Delete');
    });
});

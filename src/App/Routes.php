<?php declare(strict_types=1);

$app->get('/', 'App\Controller\DefaultController:getHelp');
$app->get('/status', 'App\Controller\DefaultController:getStatus');
$app->post('/login', 'App\Controller\User\LoginUser');

$app->group('/api/v1', function () use ($app) {
    $app->group('/tasks', function () use ($app) {
        $app->get('', 'App\Controller\Task\GetAllTasks');
        $app->get('/[{id}]', 'App\Controller\Task\GetOneTask');
        $app->get('/search/[{query}]', 'App\Controller\Task\SearchTasks');
        $app->post('', 'App\Controller\Task\CreateTask');
        $app->put('/[{id}]', 'App\Controller\Task\UpdateTask');
        $app->delete('/[{id}]', 'App\Controller\Task\DeleteTask');
    })->add(new App\Middleware\AuthMiddleware($app));
    $app->group('/users', function () use ($app) {
        $app->get('', 'App\Controller\User\GetAllUsers')->add(new App\Middleware\AuthMiddleware($app));
        $app->get('/[{id}]', 'App\Controller\User\GetOneUser')->add(new App\Middleware\AuthMiddleware($app));
        $app->get('/search/[{query}]', 'App\Controller\User\SearchUsers')->add(new App\Middleware\AuthMiddleware($app));
        $app->post('', 'App\Controller\User\CreateUser');
        $app->put('/[{id}]', 'App\Controller\User\UpdateUser')->add(new App\Middleware\AuthMiddleware($app));
        $app->delete('/[{id}]', 'App\Controller\User\DeleteUser')->add(new App\Middleware\AuthMiddleware($app));
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

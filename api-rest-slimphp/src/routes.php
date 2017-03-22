<?php

$app->get('/', function () {
    $msg = ['help' => [
            'tareas' => 'Ver Tareas: /tasks',
            'usuarios' => 'Ver Usuarios: /users',
            'version' => 'Ver Version: /version',
    ]];

    return $this->response->withJson($msg);
});

$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '0.1.10 [21 Marzo 2017]']];

    return $this->response->withJson($msg);
});

/**
 * Routes Groups: Tasks.
 */
$app->group('/tasks', function () use ($app) {
    $app->get('', function () {
        $todos = tasks::getTasks($this->db);

        return $this->response->withJson($todos);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $todos = tasks::getTask($this->db, $args['id']);

        return $this->response->withJson($todos);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $todos = tasks::searchTasks($this->db, $args['query']);

        return $this->response->withJson($todos);
    });
    $app->post('', function ($request) {
        $input = tasks::createTask($this->db, $request);

        return $this->response->withJson($input);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $input = tasks::updateTask($this->db, $request, $args['id']);

        return $this->response->withJson($input);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        tasks::deleteTask($this->db, $args['id']);

        return true;
    });
});

/**
 * Routes Groups: Users.
 */
$app->group('/users', function () use ($app) {
    $app->get('', function () {
        $result = users::getUsers($this->db);

        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $result = users::getUser($this->db, $args['id']);

        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $result = users::searchUsers($this->db, $args['query']);

        return $this->response->withJson($result, $result['code']);
    });
    $app->post('', function ($request) {
        $result = users::createUser($this->db, $request);

        return $this->response->withJson($result, $result['code']);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $result = users::updateUser($this->db, $request, $args['id']);

        return $this->response->withJson($result, $result['code']);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $result = users::deleteUser($this->db, $args['id']);

        return $this->response->withJson($result, $result['code']);
    });
});

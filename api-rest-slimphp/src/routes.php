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
    $msg = ['info' => ['api_version' => '0.1.9 [08 Febrero 2017]']];

    return $this->response->withJson($msg);
});

$app->get('/tasks', function () {
    $todos = tasks::getTasks($this->db);

    return $this->response->withJson($todos);
});

$app->get('/tasks/[{id}]', function ($request, $response, $args) {
    $todos = tasks::getTask($this->db, $args['id']);

    return $this->response->withJson($todos);
});

$app->get('/tasks/search/[{query}]', function ($request, $response, $args) {
    $todos = tasks::searchTasks($this->db, $args['query']);

    return $this->response->withJson($todos);
});

$app->post('/tasks', function ($request) {
    $input = tasks::createTask($this->db, $request);

    return $this->response->withJson($input);
});

$app->put('/tasks/[{id}]', function ($request, $response, $args) {
    $input = tasks::updateTask($this->db, $request, $args['id']);

    return $this->response->withJson($input);
});

$app->delete('/tasks/[{id}]', function ($request, $response, $args) {
    tasks::deleteTask($this->db, $args['id']);

    return true;
});

$app->get('/users', function () {
    $result = users::getUsers($this->db);

    return $this->response->withJson($result, $result['code']);
});

$app->get('/users/[{id}]', function ($request, $response, $args) {
    $result = users::getUser($this->db, $args['id']);

    return $this->response->withJson($result, $result['code']);
});

$app->get('/users/search/[{query}]', function ($request, $response, $args) {
    $result = users::searchUsers($this->db, $args['query']);

    return $this->response->withJson($result, $result['code']);
});

$app->post('/users', function ($request) {
    $result = users::createUser($this->db, $request);

    return $this->response->withJson($result, $result['code']);
});

$app->put('/users/[{id}]', function ($request, $response, $args) {
    $result = users::updateUser($this->db, $request, $args['id']);

    return $this->response->withJson($result, $result['code']);
});

$app->delete('/users/[{id}]', function ($request, $response, $args) {
    $result = users::deleteUser($this->db, $args['id']);

    return $this->response->withJson($result, $result['code']);
});

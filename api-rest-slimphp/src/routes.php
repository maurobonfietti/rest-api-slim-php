<?php

$app->get('/', function () {
    $msg = ['help' => [
            'tasks' => 'Ver Tareas: /tasks',
            'version' => 'Ver Version: /version',
    ]];

    return $this->response->withJson($msg);
});

$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '0.1.8 [05 Febrero 2017]']];

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
    $users = users::getUsers($this->db);

    return $this->response->withJson($users);
});

$app->get('/users/[{id}]', function ($request, $response, $args) {
    $user = users::getUser($this->db, $args['id']);

    return $this->response->withJson($user);
});

$app->get('/users/search/[{query}]', function ($request, $response, $args) {
    $users = users::searchUsers($this->db, $args['query']);

    return $this->response->withJson($users);
});

$app->post('/users', function ($request) {
    $result = users::createUser($this->db, $request);

    return $this->response->withJson($result);
});

$app->put('/users/[{id}]', function ($request, $response, $args) {
    $result = users::updateUser($this->db, $request, $args['id']);

    return $this->response->withJson($result);
});

$app->delete('/users/[{id}]', function ($request, $response, $args) {
    $result = users::deleteUser($this->db, $args['id']);

    return $this->response->withJson($result, $result['code']);
});

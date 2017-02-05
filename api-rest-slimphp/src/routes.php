<?php

$app->get('/', function () {
    $msg = ['help' => [
            'tasks' => 'Ver Tareas: /tasks',
            'version' => 'Ver Version: /version',
    ]];

    return $this->response->withJson($msg);
});

$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '0.1.7 [Feb. 2017]']];

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

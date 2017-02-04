<?php

$app->get('/', function () {
    $msg = ['help' => [
            'tasks' => 'Ver Tareas: /todos',
            'version' => 'Ver Version: /version',
    ]];

    return $this->response->withJson($msg);
});

$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '0.1.6 [Feb. 2017]']];

    return $this->response->withJson($msg);
});

$app->get('/todos', function () {
    $todos = tasks::getTasks($this->db);

    return $this->response->withJson($todos);
});

$app->get('/todo/[{id}]', function ($request, $response, $args) {
    $todos = tasks::getTask($this->db, $args['id']);

    return $this->response->withJson($todos);
});

$app->get('/todos/search/[{query}]', function ($request, $response, $args) {
    $todos = tasks::searchTasks($this->db, $args['query']);

    return $this->response->withJson($todos);
});

$app->post('/todo', function ($request) {
    $input = tasks::createTask($this->db, $request);

    return $this->response->withJson($input);
});

$app->put('/todo/[{id}]', function ($request, $response, $args) {
    $input = tasks::updateTask($this->db, $request, $args['id']);

    return $this->response->withJson($input);
});

$app->delete('/todo/[{id}]', function ($request, $response, $args) {
    tasks::deleteTask($this->db, $args['id']);

    return true;
});

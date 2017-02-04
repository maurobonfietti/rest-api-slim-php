<?php

// get help
$app->get('/', function () {
    $msg = ['info' => [
            'tasks' => 'View All Tasks: /todos',
            'version' => 'View Api Version: /version',
    ]];

    return $this->response->withJson($msg);
});

// get version
$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '0.1.5']];

    return $this->response->withJson($msg);
});

// get all todos
$app->get('/todos', function () {
    $todos = tasks::getAllTasks($this->db);

    return $this->response->withJson($todos);
});

// Retrieve todo with id
$app->get('/todo/[{id}]', function ($request, $response, $args) {
    $todos = tasks::getTask($request, $response, $args, $this->db);

    return $this->response->withJson($todos);
});

// Search for todo with given search teram in their name
$app->get('/todos/search/[{query}]', function ($request, $response, $args) {
    $todos = tasks::searchtTasks($request, $response, $args, $this->db);

    return $this->response->withJson($todos);
});

// Add a new todo
$app->post('/todo', function ($request) {
    $input = tasks::createTask($request, $this->db);

    return $this->response->withJson($input);
});

// Update todo with given id
$app->put('/todo/[{id}]', function ($request, $response, $args) {
    $input = tasks::updateTask($request, $response, $args, $this->db);

    return $this->response->withJson($input);
});

// Delete a todo with given id
$app->delete('/todo/[{id}]', function ($request, $response, $args) {
    tasks::deleteTask($request, $response, $args, $this->db);

    return true;
});

<?php

/**
 * Mini Help Route.
 */
$app->get('/', function () {
    $msg = ['help' => [
        'tasks' => 'Ver Tareas: /tasks',
        'users' => 'Ver Usuarios: /users',
        'version' => 'Ver Version: /version',
    ]];
    return $this->response->withJson($msg);
});

/**
 * Version Route.
 */
$app->get('/version', function () {
    $msg = ['info' => ['api_version' => '0.1.12 [23 Marzo 2017]']];
    return $this->response->withJson($msg);
});

/**
 * Tasks Routes Groups.
 */
$app->group('/tasks', function () use ($app) {
    $app->get('', function () {
        $result = tasks::getTasks($this->db);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $result = tasks::getTask($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $result = tasks::searchTasks($this->db, $args['query']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->post('', function ($request) {
        $result = tasks::createTask($this->db, $request);
        return $this->response->withJson($result, $result['code']);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $result = tasks::updateTask($this->db, $request, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $result = tasks::deleteTask($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
});

/**
 * Users Routes Groups.
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

<?php

/**
 * Help Route.
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
    $msg = ['info' => ['api_version' => '0.1.14 [03/04/2017]']];
    return $this->response->withJson($msg);
});

/**
 * Tasks Routes Groups.
 */
$app->group('/tasks', function () use ($app) {
    $app->get('', function () {
        $result = Tasks::getTasks($this->db);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $result = Tasks::getTask($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $result = Tasks::searchTasks($this->db, $args['query']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->post('', function ($request) {
        $result = Tasks::createTask($this->db, $request);
        return $this->response->withJson($result, $result['code']);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $result = Tasks::updateTask($this->db, $request, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $result = Tasks::deleteTask($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
});

/**
 * Users Routes Groups.
 */
$app->group('/users', function () use ($app) {
    $app->get('', function () {
        $result = Users::getUsers($this->db);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $result = Users::getUser($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $result = Users::searchUsers($this->db, $args['query']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->post('', function ($request) {
        $result = Users::createUser($this->db, $request);
        return $this->response->withJson($result, $result['code']);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $result = Users::updateUser($this->db, $request, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $result = Users::deleteUser($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
});

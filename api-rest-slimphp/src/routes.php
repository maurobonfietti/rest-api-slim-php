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
    $msg = ['info' => ['api_version' => '0.1.15 [03/04/2017]']];
    return $this->response->withJson($msg);
});

/**
 * Tasks Routes Groups.
 */
$app->group('/tasks', function () use ($app) {
    $app->get('', function () {
        $result = TasksController::getTasks($this->db);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $result = TasksController::getTask($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $result = TasksController::searchTasks($this->db, $args['query']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->post('', function ($request) {
        $result = TasksController::createTask($this->db, $request);
        return $this->response->withJson($result, $result['code']);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $result = TasksController::updateTask($this->db, $request, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $result = TasksController::deleteTask($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
});

/**
 * Users Routes Groups.
 */
$app->group('/users', function () use ($app) {
    $app->get('', function () {
        $result = UsersController::getUsers($this->db);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $result = UsersController::getUser($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $result = UsersController::searchUsers($this->db, $args['query']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->post('', function ($request) {
        $result = UsersController::createUser($this->db, $request);
        return $this->response->withJson($result, $result['code']);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $result = UsersController::updateUser($this->db, $request, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $result = UsersController::deleteUser($this->db, $args['id']);
        return $this->response->withJson($result, $result['code']);
    });
});

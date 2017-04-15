<?php

/**
 * Help Route.
 */
$app->get('/', function () {
    $result = Base::getHelp();
    return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
});

/**
 * Version Route.
 */
//$app->get('/version', '\Base:getVersionTest');
$app->get('/version', function () {
    $result = Base::getVersion();
    return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
});

/**
 * Tasks Routes Groups.
 */
$app->group('/tasks', function () use ($app) {
    $app->get('', '\TasksController:getTasks');
    $app->get('/[{id}]', '\TasksController:getTask');
    $app->get('/search/[{query}]', '\TasksController:searchTasks');
    $app->post('', '\TasksController:createTask');
    $app->put('/[{id}]', '\TasksController:updateTask');
    $app->delete('/[{id}]', '\TasksController:deleteTask');
});

/**
 * Users Routes Groups.
 */
$app->group('/users', function () use ($app) {
    $app->get('', function () {
        $users = new UsersController($this->db);
        $result = $users->getUsers();
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->get('/[{id}]', function ($request, $response, $args) {
        $users = new UsersController($this->db);
        $result = $users->getUser($args['id']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->get('/search/[{query}]', function ($request, $response, $args) {
        $users = new UsersController($this->db);
        $result = $users->searchUsers($args['query']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->post('', function ($request) {
        $users = new UsersController($this->db);
        $result = $users->createUser($request);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->put('/[{id}]', function ($request, $response, $args) {
        $users = new UsersController($this->db);
        $result = $users->updateUser($request, $args['id']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->delete('/[{id}]', function ($request, $response, $args) {
        $users = new UsersController($this->db);
        $result = $users->deleteUser($args['id']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
});

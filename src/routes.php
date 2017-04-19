<?php

/**
 * Help Route.
 */
$app->get('/', 'App\Controller\DefaultController:getHelp');

/**
 * Version Route.
 */
$app->get('/version', 'App\Controller\DefaultController:getVersion');

/**
 * Tasks Routes Groups.
 */
$app->group('/tasks', function() use ($app) {
    $app->get('', 'App\Controller\TasksController:getTasks');
    $app->get('/[{id}]', 'App\Controller\TasksController:getTask');
    $app->get('/search/[{query}]', 'App\Controller\TasksController:searchTasks');
    $app->post('', 'App\Controller\TasksController:createTask');
    $app->put('/[{id}]', 'App\Controller\TasksController:updateTask');
    $app->delete('/[{id}]', 'App\Controller\TasksController:deleteTask');
});

/**
 * Users Routes Groups.
 */
$app->group('/users', function() use ($app) {
    $app->get('', function() {
        $users = new App\Controller\UsersController($this->db);
        $result = $users->getUsers();
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->get('/[{id}]', function($request, $response, $args) {
        $users = new App\Controller\UsersController($this->db);
        $result = $users->getUser($args['id']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->get('/search/[{query}]', function($request, $response, $args) {
        $users = new App\Controller\UsersController($this->db);
        $result = $users->searchUsers($args['query']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->post('', function($request) {
        $users = new App\Controller\UsersController($this->db);
        $result = $users->createUser($request);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->put('/[{id}]', function($request, $response, $args) {
        $users = new App\Controller\UsersController($this->db);
        $result = $users->updateUser($request, $args['id']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
    $app->delete('/[{id}]', function($request, $response, $args) {
        $users = new App\Controller\UsersController($this->db);
        $result = $users->deleteUser($args['id']);
        return $this->response->withJson($result, $result['code'], JSON_PRETTY_PRINT);
    });
});

<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Service\UserService;

/**
 * Users Controller.
 */
class UserController extends BaseController
{
    /**
     * @param \Slim\Container $container
     */
    public function __construct(\Slim\Container $container)
    {
        $this->logger = $container->get('logger');
        $this->database = $container->get('db');
    }

    /**
     * Get all users.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getUsers($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $service = new UserService($this->database);
        $result = $service->getUsers();

        return $this->jsonResponse('success', $result, 200);
    }

    /**
     * Get one user by id.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getUser($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $service = new UserService($this->database);
            $result = $service->getUser($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Search users by name.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function searchUsers($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $service = new UserService($this->database);
            $result = $service->searchUsers($this->args['query']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Create a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function createUser($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $service = new UserService($this->database);
            $input = $this->request->getParsedBody();
            $result = $service->createUser($input);

            return $this->jsonResponse('success', $result, 201);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Update a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function updateUser($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $input = $this->request->getParsedBody();
        $service = new UserService($this->database);
        try {
            $result = $service->updateUser($input, $this->args['id']);
            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Delete a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function deleteUser($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $service = new UserService($this->database);
            $result = $service->deleteUser($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

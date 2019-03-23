<?php

namespace App\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

use \Firebase\JWT\JWT;

/**
 * Default Controller.
 */
class DefaultController extends BaseController
{
    const API_VERSION = '19.02';

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Get Help.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getHelp($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $url = getenv('APP_DOMAIN');
        $endpoints = [
            'tasks' => $url . '/api/v1/tasks',
            'users' => $url . '/api/v1/users',
            'notes' => $url . '/api/v1/notes',
            'status' => $url . '/status',
            'this help' => $url . '',
        ];
        $message = [
            'endpoints' => $endpoints,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse('success', $message, 200);
    }

    /**
     * Get API Status.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getStatus($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $userService = $this->container->get('user_service');
        $taskService = $this->container->get('task_service');
        $noteService = $this->container->get('note_service');
        $db = [
            'users' => count($userService->getUsers()),
            'tasks' => count($taskService->getTasks()),
            'notes' => count($noteService->getNotes()),
        ];
        $status = [
            'db' => $db,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse('success', $status, 200);
    }

    /**
     * Get Login.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function getLogin($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $data = json_decode(json_encode($input), false);
        $userService = $this->container->get('user_service');
        $asd = $userService->login($data->email, $data->password);
        var_dump($asd); exit;
        $db = [
            'users' => count($userService->getUsers()),
        ];
        $status = [
            'db' => $db,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        $key = "example_key";
        $token = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
        );
        $jwt = JWT::encode($token, $key);
//        print_r($jwt); exit;
//        $decoded = JWT::decode($jwt, $key, array('HS256'));
//        print_r($decoded); exit;
//        $decoded_array = (array) $decoded;
//        print_r($decoded_array); exit;
        $hashed = hash("sha512", '123');
        var_dump($hashed); exit;

        return $this->jsonResponse('success', $status, 200);
    }
}

<?php declare(strict_types=1);

namespace App\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class DefaultController extends BaseController
{
    const API_VERSION = '0.25.0';

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getHelp(Request $request, Response $response, array $args): Response
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

    public function getStatus(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $userService = $this->container->get('user_service');
        $noteService = $this->container->get('note_service');
        $taskService = $this->container->get('task_service');
        $db = [
            'users' => count($userService->getUsers()),
            'tasks' => count($taskService->getAllTasks()),
            'notes' => count($noteService->getNotes()),
        ];
        $status = [
            'db' => $db,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse('success', $status, 200);
    }
}

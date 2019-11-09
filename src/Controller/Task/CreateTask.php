<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class CreateTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $request->getParsedBody();
        $task = $this->getTaskService()->createTask($input);

        return $this->jsonResponse($response, 'success', $task, 201);
    }
}

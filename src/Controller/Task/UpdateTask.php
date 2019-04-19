<?php

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class UpdateTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $task = $this->getTaskService()->updateTask($input, $this->args['id']);

        return $this->jsonResponse('success', $task, 200);
    }
}

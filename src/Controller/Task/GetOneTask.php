<?php

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOneTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $userId = $input['decoded']->sub;
        $task = $this->getTaskService()->getTask($this->args['id'], $userId);

        return $this->jsonResponse('success', $task, 200);
    }
}

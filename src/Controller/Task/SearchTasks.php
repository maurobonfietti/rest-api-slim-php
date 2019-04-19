<?php

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class SearchTasks extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $userId = $input['decoded']->sub;
        $tasks = $this->getTaskService()->searchTasks($this->args['query'], $userId);

        return $this->jsonResponse('success', $tasks, 200);
    }
}

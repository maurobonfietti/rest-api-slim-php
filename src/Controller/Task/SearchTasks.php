<?php

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Search Tasks Controller.
 */
class SearchTasks extends BaseTask
{
    /**
     * Search tasks by name.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $userId = $input['decoded']->sub;
        $tasks = $this->getTaskService()->searchTasks($this->args['query'], $userId);

        return $this->jsonResponse('success', $tasks, 200);
    }
}

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
        $taskName = $this->args['query'];
        $result = $this->getTaskService()->searchTasks($taskName);

        return $this->jsonResponse('success', $result, 200);
    }
}

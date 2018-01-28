<?php

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Update Task Controller.
 */
class UpdateTask extends BaseTask
{
    /**
     * Update a task.
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
        $taskId = $this->args['id'];
        $result = $this->getTaskService()->updateTask($input, $taskId);

        return $this->jsonResponse('success', $result, 200);
    }
}

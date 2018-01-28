<?php

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Create Task Controller.
 */
class CreateTask extends BaseTask
{
    /**
     * Create a task.
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
        $result = $this->getTaskService()->createTask($input);

        return $this->jsonResponse('success', $result, 201);
    }
}

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
        try {
            $this->setParams($request, $response, $args);
            $input = $this->getInput();
            $result = $this->getTaskService()->updateTask($input, $this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

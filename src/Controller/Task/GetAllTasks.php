<?php

namespace App\Controller\Task;

/**
 * Get All Tasks Controller.
 */
class GetAllTasks extends BaseTask
{
    /**
     * Get all tasks.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getTasks($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $result = $this->getTaskService()->getTasks();

        return $this->jsonResponse('success', $result, 200);
    }
}

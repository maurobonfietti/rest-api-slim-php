<?php

namespace App\Controller\Task;

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
     * @return array
     */
    public function searchTasks($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getTaskService()->searchTasks($this->args['query']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

<?php

namespace App\Controller\Task;

/**
 * Delete Task Controller.
 */
class DeleteTask extends BaseTask
{
    /**
     * Delete a task.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function deleteTask($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getTaskService()->deleteTask($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

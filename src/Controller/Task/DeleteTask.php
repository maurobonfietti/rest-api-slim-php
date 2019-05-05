<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class DeleteTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $taskId = (int) $this->args['id'];
        $userId = (int) $input['decoded']->sub;
        $task = $this->getTaskService()->deleteTask($taskId, $userId);

        return $this->jsonResponse('success', $task, 204);
    }
}

<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class DeleteTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $taskId = (int) $args['id'];
        $userId = (int) $input['decoded']->sub;
        $task = $this->getTaskService()->deleteTask($taskId, $userId);

        return $this->jsonResponse($response, 'success', $task, 204);
    }
}

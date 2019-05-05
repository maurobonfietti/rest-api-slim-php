<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOneTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $taskId = (int) $this->args['id'];
        $userId = (int) $input['decoded']->sub;
        $task = $this->getTaskService()->getTask($taskId, $userId);

        return $this->jsonResponse('success', $task, 200);
    }
}

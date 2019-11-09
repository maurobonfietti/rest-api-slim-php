<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAllTasks extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $userId = (int) $input['decoded']->sub;
        $tasks = $this->getTaskService()->getTasks($userId);

        return $this->jsonResponse($response, 'success', $tasks, 200);
    }
}

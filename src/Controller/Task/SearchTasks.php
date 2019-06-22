<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class SearchTasks extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $userId = (int) $input['decoded']->sub;
        $query = '';
        if (isset($this->args['query'])) {
            $query = $this->args['query'];
        }
        $status = $request->getParam('status', null);
        $tasks = $this->getTaskService()->searchTasks($query, $userId, $status);

        return $this->jsonResponse('success', $tasks, 200);
    }
}

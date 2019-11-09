<?php declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

class UpdateTask extends BaseTask
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $task = $this->getTaskService()->updateTask($input, (int) $args['id']);

        return $this->jsonResponse($response, 'success', $task, 200);
    }
}

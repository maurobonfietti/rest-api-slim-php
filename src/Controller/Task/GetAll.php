<?php

declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = $request->getParsedBody();
        $userId = (int) $input['decoded']->sub;
        $tasks = $this->getTaskService()->getAll($userId);

        return $this->jsonResponse($response, 'success', $tasks, 200);
    }
}

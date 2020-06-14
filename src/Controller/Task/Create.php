<?php

declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $task = $this->getTaskService()->create($input);

        return $this->jsonResponse($response, 'success', $task, 201);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $task = $this->getTaskService()->update($input, (int) $args['id']);

        return $this->jsonResponse($response, 'success', $task, 200);
    }
}

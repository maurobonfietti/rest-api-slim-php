<?php

declare(strict_types=1);

namespace App\Controller\Task;

use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends Base
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
        $taskId = (int) $args['id'];
        $userId = $this->getAndValidateUserId($input);
        $this->getTaskService()->delete($taskId, $userId);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}

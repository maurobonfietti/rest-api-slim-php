<?php

declare(strict_types=1);

namespace App\Controller\Note;

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
        $this->getServiceDeleteNote()->delete((int) $args['id']);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}

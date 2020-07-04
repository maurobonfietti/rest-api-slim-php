<?php

declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $note = $this->getServiceCreateNote()->create($input);

        return $this->jsonResponse($response, 'success', $note, 201);
    }
}

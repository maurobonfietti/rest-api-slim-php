<?php

declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $notes = $this->getNoteService()->getAll();

        return $this->jsonResponse($response, 'success', $notes, 200);
    }
}

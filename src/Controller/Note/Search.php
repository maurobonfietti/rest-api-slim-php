<?php

declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class Search extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $notes = $this->searchNoteService()->search($args['query']);

        return $this->jsonResponse($response, 'success', $notes, 200);
    }
}

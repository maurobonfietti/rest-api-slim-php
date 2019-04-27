<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class SearchNotes extends BaseNote
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $notes = $this->getNoteService()->searchNotes($this->args['query']);

        return $this->jsonResponse('success', $notes, 200);
    }
}

<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAllNotes extends BaseNote
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $notes = $this->getNoteService()->getNotes();

        return $this->jsonResponse($response, 'success', $notes, 200);
    }
}

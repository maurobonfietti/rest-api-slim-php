<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class DeleteNote extends BaseNote
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->getNoteService()->deleteNote((int) $args['id']);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}

<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class DeleteNote extends BaseNote
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $this->getNoteService()->deleteNote((int) $args['id']);

        return $this->jsonResponse('success', null, 204);
    }
}

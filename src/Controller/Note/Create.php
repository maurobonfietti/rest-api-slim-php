<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class Create extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $note = $this->createNoteService()->create($input);

        return $this->jsonResponse($response, 'success', $note, 201);
    }
}

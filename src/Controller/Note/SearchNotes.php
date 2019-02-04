<?php

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Search Notes Controller.
 */
class SearchNotes extends BaseNote
{
    /**
     * Search notes by name.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $notes = $this->getNoteService()->searchNotes($this->args['query']);

        return $this->jsonResponse('success', $notes, 200);
    }
}

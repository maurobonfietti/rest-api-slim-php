<?php

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get All Notes Controller.
 */
class GetAllNotes extends BaseNote
{
    /**
     * Get all notes.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $result = $this->getNoteService()->getNotes();

        return $this->jsonResponse('success', $result, 200);
    }
}

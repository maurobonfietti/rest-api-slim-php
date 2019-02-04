<?php

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get One Note Controller.
 */
class GetOneNote extends BaseNote
{
    /**
     * Get one note by id.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        if ($this->useRedis() === true) {
            $note = $this->getNoteFromCache($this->args['id']);
        } else {
            $note = $this->getNoteService()->getNote($this->args['id']);
        }

        return $this->jsonResponse('success', $note, 200);
    }

    /**
     * @param int $noteId
     * @return object
     */
    private function getNoteFromCache($noteId)
    {
        $note = $this->getFromCache($noteId);
        if ($note === null) {
            $note = $this->getNoteService()->getNote($noteId);
            $this->saveInCache($noteId, $note);
        }

        return $note;
    }
}

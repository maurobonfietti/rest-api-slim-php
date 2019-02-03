<?php

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Delete Note Controller.
 */
class DeleteNote extends BaseNote
{
    /**
     * Delete a note.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $this->getNoteService()->deleteNote($this->args['id']);
        if ($this->useRedis() === true) {
            $this->deleteFromCache($this->args['id']);
        }

        return $this->jsonResponse('success', null, 204);
    }
}

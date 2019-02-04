<?php

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Create Note Controller.
 */
class CreateNote extends BaseNote
{
    /**
     * Create a note.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $note = $this->getNoteService()->createNote($input);
        if ($this->useRedis() === true) {
            $this->saveInCache($note->id, $note);
        }

        return $this->jsonResponse('success', $note, 201);
    }
}

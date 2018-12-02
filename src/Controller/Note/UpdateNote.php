<?php

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Update Note Controller.
 */
class UpdateNote extends BaseNote
{
    /**
     * Update a note.
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
        $result = $this->getNoteService()->updateNote($input, $this->args['id']);
        if (getenv('USE_REDIS_CACHE') == true) {
            $this->saveInCache($this->args['id'], $result);
        }

        return $this->jsonResponse('success', $result, 200);
    }
}

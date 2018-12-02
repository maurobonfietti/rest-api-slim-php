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
        $result = $this->getNoteService()->createNote($input);
        if (getenv('USE_REDIS_CACHE') == true) {
            $this->saveInCache($result->id, $result);
        }
//        $this->saveInCache($result->id, $result);

        return $this->jsonResponse('success', $result, 201);
    }
}

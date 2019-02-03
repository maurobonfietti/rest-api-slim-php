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
            $result = $this->getFromCache($this->args['id']);
            if ($result === null) {
                $result = $this->getNoteService()->getNote($this->args['id']);
                $this->saveInCache($this->args['id'], $result);
            }
        } else {
            $result = $this->getNoteService()->getNote($this->args['id']);
        }

        return $this->jsonResponse('success', $result, 200);
    }
}

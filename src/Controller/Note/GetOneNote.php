<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOneNote extends BaseNote
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        if ($this->useRedis() === true) {
            $note = $this->getNoteFromCache((int) $this->args['id']);
        } else {
            $note = $this->getNoteService()->getNote((int) $this->args['id']);
        }

        return $this->jsonResponse('success', $note, 200);
    }

    /**
     * @param int $noteId
     * @return mixed
     */
    private function getNoteFromCache(int $noteId)
    {
        $note = $this->getFromCache($noteId);
        if ($note === null) {
            $note = $this->getNoteService()->getNote($noteId);
            $this->saveInCache($noteId, $note);
        }

        return $note;
    }
}

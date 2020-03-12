<?php

declare(strict_types=1);

namespace App\Service\Note;

class Delete extends BaseNoteService
{
    public function delete(int $noteId)
    {
        $this->getOneFromDb($noteId);
        $this->noteRepository->deleteNote($noteId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($noteId);
        }
    }
}

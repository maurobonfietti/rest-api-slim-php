<?php

declare(strict_types=1);

namespace App\Service\Note;

//use App\Exception\NoteException;
use App\Service\NoteService;

class GetOneNoteService extends NoteService
{
    public function getNote(int $noteId)
    {
        $key = $this->redisService->generateKey("note:$noteId");
        if ($this->redisService->exists($key)) {
            $note = $this->redisService->get($key);
        } else {
            $note = $this->checkAndGetNote($noteId);
            $this->redisService->setex($key, $note);
        }

        return $note;
    }
}

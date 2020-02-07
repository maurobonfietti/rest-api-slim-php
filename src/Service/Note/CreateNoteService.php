<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Exception\NoteException;
use App\Service\NoteService;

class CreateNoteService extends NoteService
{
    public function createNote($input)
    {
        $note = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new NoteException('Invalid data: name is required.', 400);
        }
        $note->name = self::validateNoteName($data->name);
        $note->description = null;
        if (isset($data->description)) {
            $note->description = $data->description;
        }
        $notes = $this->noteRepository->createNote($note);
        $redisKey = sprintf(self::REDIS_KEY, $notes->id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $notes);

        return $notes;
    }
}

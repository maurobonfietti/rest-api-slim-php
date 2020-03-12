<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Exception\NoteException;

class Create extends BaseNoteService
{
    public function create($input)
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
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($notes->id, $notes);
        }

        return $notes;
    }
}

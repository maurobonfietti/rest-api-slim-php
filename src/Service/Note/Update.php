<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Exception\NoteException;

class Update extends BaseNoteService
{
    public function update($input, int $noteId)
    {
        $note = $this->getOneFromDb($noteId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->description)) {
            throw new NoteException('Enter the data to update the note.', 400);
        }
        if (isset($data->name)) {
            $note->name = self::validateNoteName($data->name);
        }
        if (isset($data->description)) {
            $note->description = $data->description;
        }
        $notes = $this->noteRepository->updateNote($note);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($notes->id, $notes);
        }

        return $notes;
    }
}

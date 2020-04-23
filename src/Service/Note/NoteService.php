<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Exception\Note;

final class NoteService extends BaseNoteService
{
    public function getAll(): array
    {
        return $this->noteRepository->getNotes();
    }

    public function getOne(int $noteId)
    {
        if (self::isRedisEnabled() === true) {
            $note = $this->getOneFromCache($noteId);
        } else {
            $note = $this->getOneFromDb($noteId);
        }

        return $note;
    }

    public function search(string $notesName): array
    {
        return $this->noteRepository->searchNotes($notesName);
    }

    public function create($input)
    {
        $note = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new Note('Invalid data: name is required.', 400);
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

    public function update($input, int $noteId)
    {
        $note = $this->getOneFromDb($noteId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->description)) {
            throw new Note('Enter the data to update the note.', 400);
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

    public function delete(int $noteId): void
    {
        $this->getOneFromDb($noteId);
        $this->noteRepository->deleteNote($noteId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($noteId);
        }
    }
}

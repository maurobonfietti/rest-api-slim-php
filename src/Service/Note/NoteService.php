<?php

declare(strict_types=1);

namespace App\Service\Note;

final class NoteService extends Base
{
    public function getAll(): array
    {
        return $this->noteRepository->getNotes();
    }

    public function getOne(int $noteId): object
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

    public function delete(int $noteId): void
    {
        $this->getOneFromDb($noteId);
        $this->noteRepository->deleteNote($noteId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($noteId);
        }
    }
}

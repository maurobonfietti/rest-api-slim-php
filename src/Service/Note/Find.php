<?php

declare(strict_types=1);

namespace App\Service\Note;

final class Find extends Base
{
    public function getAll(): array
    {
        return $this->noteRepository->getNotes();
    }

    public function getNotesByPage($page, $perPage): array
    {
        return $this->noteRepository->getNotesByPage($page, $perPage);
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
}

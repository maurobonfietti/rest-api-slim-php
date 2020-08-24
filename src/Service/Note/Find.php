<?php

declare(strict_types=1);

namespace App\Service\Note;

final class Find extends Base
{
    public function getAll(): array
    {
        return $this->noteRepository->getNotes();
    }

    public function getNotesByPage($page, $perPage, $name, $description): array
    {
        if (! is_numeric($page) || $page < 1) {
            $page = 1;
        }
        if (! is_numeric($perPage) || $perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->noteRepository->getNotesByPage($page, $perPage, $name, $description);
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

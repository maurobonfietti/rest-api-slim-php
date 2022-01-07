<?php

declare(strict_types=1);

namespace App\Service\Note;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->noteRepository->getNotes();
    }

    /**
     * @return array<string>
     */
    public function getNotesByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->noteRepository->getNotesByPage(
            $page,
            $perPage,
            $name,
            $description
        );
    }

    public function getOne(int $noteId): object
    {
        if (self::isRedisEnabled() === true) {
            $note = $this->getOneFromCache($noteId);
        } else {
            $note = $this->getOneFromDb($noteId)->toJson();
        }

        return $note;
    }
}

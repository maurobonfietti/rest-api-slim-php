<?php

declare(strict_types=1);

namespace App\Service\Note;

final class Delete extends Base
{
    public function delete(int $noteId): void
    {
        $this->getOneFromDb($noteId);
        $this->noteRepository->deleteNote($noteId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($noteId);
        }
    }
}

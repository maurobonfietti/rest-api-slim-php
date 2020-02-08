<?php

declare(strict_types=1);

namespace App\Service\Note;

class GetAllNoteService extends BaseNoteService
{
    public function getNotes(): array
    {
        return $this->noteRepository->getNotes();
    }
}

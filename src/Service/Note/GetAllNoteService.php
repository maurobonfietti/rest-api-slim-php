<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Service\NoteService;

class GetAllNoteService extends NoteService
{
    public function getNotes(): array
    {
        return $this->noteRepository->getNotes();
    }
}

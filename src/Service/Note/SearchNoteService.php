<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Service\NoteService;

class SearchNoteService extends NoteService
{
    public function searchNotes(string $notesName): array
    {
        return $this->noteRepository->searchNotes($notesName);
    }
}

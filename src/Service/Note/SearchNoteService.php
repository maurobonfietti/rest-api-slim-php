<?php

declare(strict_types=1);

namespace App\Service\Note;

class SearchNoteService extends BaseNoteService
{
    public function searchNotes(string $notesName): array
    {
        return $this->noteRepository->searchNotes($notesName);
    }
}

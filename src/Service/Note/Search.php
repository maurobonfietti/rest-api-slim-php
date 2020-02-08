<?php

declare(strict_types=1);

namespace App\Service\Note;

class Search extends BaseNoteService
{
    public function search(string $notesName): array
    {
        return $this->noteRepository->searchNotes($notesName);
    }
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\NoteException;
use App\Repository\NoteRepository;

class NoteService extends BaseService
{
    /**
     * @var NoteRepository
     */
    protected $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    protected function checkAndGetNote(int $noteId)
    {
        return $this->noteRepository->checkAndGetNote($noteId);
    }

    public function getNotes(): array
    {
        return $this->noteRepository->getNotes();
    }

    public function getNote(int $noteId)
    {
        return $this->checkAndGetNote($noteId);
    }

    public function searchNotes(string $notesName): array
    {
        return $this->noteRepository->searchNotes($notesName);
    }

    public function createNote($input)
    {
        $note = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new NoteException('Invalid data: name is required.', 400);
        }
        $note->name = self::validateNoteName($data->name);
        $note->description = null;
        if (isset($data->description)) {
            $note->description = $data->description;
        }

        return $this->noteRepository->createNote($note);
    }

    public function updateNote($input, int $noteId)
    {
        $note = $this->checkAndGetNote($noteId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->description)) {
            throw new NoteException('Enter the data to update the note.', 400);
        }
        if (isset($data->name)) {
            $note->name = self::validateNoteName($data->name);
        }
        if (isset($data->description)) {
            $note->description = $data->description;
        }

        return $this->noteRepository->updateNote($note);
    }

    public function deleteNote(int $noteId)
    {
        $this->checkAndGetNote($noteId);
        $this->noteRepository->deleteNote($noteId);
    }
}

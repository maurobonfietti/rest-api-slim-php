<?php

namespace App\Service;

use App\Exception\NoteException;
use App\Repository\NoteRepository;
use App\Validation\NoteValidation as vs;

/**
 * Notes Service.
 */
class NoteService extends BaseService
{
    /**
     * @var NoteRepository
     */
    protected $noteRepository;

    /**
     * @param NoteRepository $noteRepository
     */
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Check if the note exists.
     *
     * @param int $noteId
     * @return object
     */
    protected function checkNote($noteId)
    {
        $note = $this->noteRepository->checkNote($noteId);

        return $note;
    }

    /**
     * Get all notes.
     *
     * @return array
     */
    public function getNotes()
    {
        $notes = $this->noteRepository->getNotes();

        return $notes;
    }

    /**
     * Get one note by id.
     *
     * @param int $noteId
     * @return object
     */
    public function getNote($noteId)
    {
        $note = $this->checkNote($noteId);

        return $note;
    }

    /**
     * Search notes by name.
     *
     * @param string $notesName
     * @return array
     */
    public function searchNotes($notesName)
    {
        $notes = $this->noteRepository->searchNotes($notesName);

        return $notes;
    }

    /**
     * Create a note.
     *
     * @param array $input
     * @return object
     */
    public function createNote($input)
    {
        $data = vs::validateInputOnCreateNote($input);
        $note = $this->noteRepository->createNote($data);

        return $note;
    }

    /**
     * Update a note.
     *
     * @param array $input
     * @param int $noteId
     * @return object
     */
    public function updateNote($input, $noteId)
    {
        $checkNote = $this->checkNote($noteId);
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new NoteException(NoteException::NOTE_INFO_REQUIRED, 400);
        }
        $data = [];
        $data['name'] = vs::validateNameOnUpdateNote($input, $checkNote);
        $data['email'] = vs::validateEmailOnUpdateNote($input, $checkNote);
        $note = $this->noteRepository->updateNote($data, $noteId);

        return $note;
    }

    /**
     * Delete a note.
     *
     * @param int $noteId
     * @return string
     */
    public function deleteNote($noteId)
    {
        $this->checkNote($noteId);
        $response = $this->noteRepository->deleteNote($noteId);

        return $response;
    }
}

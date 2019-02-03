<?php

namespace App\Service;

use App\Exception\NoteException;
use App\Repository\NoteRepository;

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
    protected function checkAndGetNote($noteId)
    {
        return $this->noteRepository->checkAndGetNote($noteId);
    }

    /**
     * Get all notes.
     *
     * @return array
     */
    public function getNotes()
    {
        return $this->noteRepository->getNotes();
    }

    /**
     * Get one note by id.
     *
     * @param int $noteId
     * @return object
     */
    public function getNote($noteId)
    {
        return $this->checkAndGetNote($noteId);
    }

    /**
     * Search notes by name.
     *
     * @param string $notesName
     * @return array
     */
    public function searchNotes($notesName)
    {
        return $this->noteRepository->searchNotes($notesName);
    }

    /**
     * Create a note.
     *
     * @param array $input
     * @return object
     * @throws NoteException
     */
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

    /**
     * Update a note.
     *
     * @param array $input
     * @param int $noteId
     * @return object
     * @throws NoteException
     */
    public function updateNote($input, $noteId)
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

    /**
     * Delete a note.
     *
     * @param int $noteId
     * @return string
     */
    public function deleteNote($noteId)
    {
        $this->checkAndGetNote($noteId);
        $this->noteRepository->deleteNote($noteId);
    }
}

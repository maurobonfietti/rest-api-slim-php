<?php

namespace App\Repository;

use App\Message\NoteMessage;
use App\Exception\NoteException;
use App\Repository\Query\NoteQuery;

/**
 * Notes Repository.
 */
class NoteRepository extends BaseRepository
{
    /**
     * @param \PDO $database
     */
    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    /**
     * Check if the note exists.
     *
     * @param int|string $noteId
     * @return object $note
     * @throws \Exception
     */
    public function checkAndGetNote($noteId)
    {
        $statement = $this->database->prepare(NoteQuery::GET_NOTE_QUERY);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
        $note = $statement->fetchObject();
        if (empty($note)) {
            throw new NoteException(NoteException::NOTE_NOT_FOUND, 404);
        }

        return $note;
    }

    /**
     * Get all notes.
     *
     * @return array
     */
    public function getNotes()
    {
        $statement = $this->database->prepare(NoteQuery::GET_NOTES_QUERY);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Search notes by name.
     *
     * @param string $notesName
     * @return array
     * @throws \Exception
     */
    public function searchNotes($notesName)
    {
        $statement = $this->database->prepare(NoteQuery::SEARCH_NOTES_QUERY);
        $query = '%' . $notesName . '%';
        $statement->bindParam('name', $query);
        $statement->execute();
        $notes = $statement->fetchAll();
        if (!$notes) {
            throw new NoteException(NoteException::NOTE_NAME_NOT_FOUND, 404);
        }

        return $notes;
    }

    /**
     * Create a note.
     *
     * @param object $data
     * @return object
     */
    public function createNote($data)
    {
        $statement = $this->database->prepare(NoteQuery::CREATE_NOTE_QUERY);
        $statement->bindParam(':name', $data->name);
        $statement->bindParam(':description', $data->description);
        $statement->execute();

        return $this->checkAndGetNote($this->database->lastInsertId());
    }

    /**
     * Update a note.
     *
     * @param object $note
     * @return object
     */
    public function updateNote($note)
    {
        $statement = $this->database->prepare(NoteQuery::UPDATE_NOTE_QUERY);
        $statement->bindParam(':id', $note->id);
        $statement->bindParam(':name', $note->name);
        $statement->bindParam(':description', $note->description);
        $statement->execute();

        return $this->checkAndGetNote($note->id);
    }

    /**
     * Delete a note.
     *
     * @param int $noteId
     * @return string
     */
    public function deleteNote($noteId)
    {
        $statement = $this->database->prepare(NoteQuery::DELETE_NOTE_QUERY);
        $statement->bindParam(':id', $noteId);
        $statement->execute();

        return NoteMessage::NOTE_DELETED;
    }
}

<?php

namespace App\Repository;

use App\Exception\NoteException;

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
     * @return object
     * @throws NoteException
     */
    public function checkAndGetNote($noteId)
    {
        $query = 'SELECT * FROM notes WHERE id = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
        $note = $statement->fetchObject();
        if (empty($note)) {
            throw new NoteException('Note not found.', 404);
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
        $query = 'SELECT * FROM notes ORDER BY id';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Search notes by name.
     *
     * @param string $notesName
     * @return array
     * @throws NoteException
     */
    public function searchNotes($notesName)
    {
        $query = 'SELECT * FROM notes WHERE UPPER(name) LIKE :name ORDER BY id';
        $name = '%' . $notesName . '%';
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $name);
        $statement->execute();
        $notes = $statement->fetchAll();
        if (!$notes) {
            throw new NoteException('No notes with that name were found.', 404);
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
        $query = 'INSERT INTO notes (name, description) VALUES (:name, :description)';
        $statement = $this->database->prepare($query);
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
        $query = 'UPDATE notes SET name = :name, description = :description WHERE id = :id';
        $statement = $this->database->prepare($query);
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
     */
    public function deleteNote($noteId)
    {
        $query = 'DELETE FROM notes WHERE id = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
    }
}

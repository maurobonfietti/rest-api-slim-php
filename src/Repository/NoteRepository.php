<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Note;
use App\Exception;

final class NoteRepository extends BaseRepository
{
    public function checkAndGetNote(int $noteId): Note
    {
        $query = 'SELECT * FROM `notes` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
        $note = $statement->fetchObject(Note::class);
        if (! $note) {
            throw new Exception\Note('Note not found.', 404);
        }

        return $note;
    }

    public function getNotes(): array
    {
        $query = 'SELECT * FROM `notes` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

//        return $statement->fetchAll();
        return $statement->fetchAll(\PDO::FETCH_CLASS, Note::class);
    }

    public function getQueryNotesByPage(): string
    {
        return "
            SELECT *
            FROM `notes`
            WHERE `name` LIKE CONCAT('%',:name,'%')
            AND `description` LIKE CONCAT('%',:description,'%')
            ORDER BY `id`
        ";
    }

    public function getNotesByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : '%' . $name . '%',
            'description' => is_null($description) ? '' : '%'.$description.'%',
        ];
        $query = $this->getQueryNotesByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $params['name']);
        $statement->bindParam('description', $params['description']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $params,
            $total
        );
    }

    public function searchNotes(string $strNotes): array
    {
        $query = '
            SELECT *
            FROM `notes`
            WHERE `name` LIKE :name OR `description` LIKE :description
            ORDER BY `id`
        ';
        $name = '%' . $strNotes . '%';
        $description = '%' . $strNotes . '%';
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $name);
        $statement->bindParam('description', $description);
        $statement->execute();
        $notes = $statement->fetchAll();
        if (! $notes) {
            $message = 'No notes were found with that name or description.';
            throw new Exception\Note($message, 404);
        }

        return $notes;
    }

    public function createNote(Note $note): Note
    {
        $query = '
            INSERT INTO `notes`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':name', $note->getName());
        $statement->bindParam(':description', $note->getDescription());
        $statement->execute();

        return $this->checkAndGetNote((int) $this->database->lastInsertId());
    }

    public function updateNote(object $note): Note
    {
        $query = '
            UPDATE `notes`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $note->id);
        $statement->bindParam(':name', $note->name);
        $statement->bindParam(':description', $note->description);
        $statement->execute();

        return $this->checkAndGetNote((int) $note->id);
    }

    public function deleteNote(int $noteId): void
    {
        $query = 'DELETE FROM `notes` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
    }
}

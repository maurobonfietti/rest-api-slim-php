<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\Note;

final class NoteRepository extends BaseRepository
{
    public function checkAndGetNote(int $noteId): object
    {
        $query = 'SELECT * FROM `notes` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
        $note = $statement->fetchObject();
        if (! $note) {
            throw new Note('Note not found.', 404);
        }

        return $note;
    }

    public function getNotes(): array
    {
        $query = 'SELECT * FROM `notes` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getNotesByPage($page, $perPage): array
    {
        $query = "SELECT * FROM `notes`";
        $statement = $this->database->prepare($query);
        $statement->execute();
        $total = $statement->rowCount();

        return [
            'pagination' => [
                'totalRows' => $total,
                'totalPages' => ceil($total / $perPage),
                'currentPage' => $page,
                'perPage' => $perPage,
            ],
            'data' => $this->getResultByPage($query, $page, $perPage),
        ];
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
            throw new Note($message, 404);
        }

        return $notes;
    }

    public function createNote(object $data): object
    {
        $query = '
            INSERT INTO `notes`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':name', $data->name);
        $statement->bindParam(':description', $data->description);
        $statement->execute();

        return $this->checkAndGetNote((int) $this->database->lastInsertId());
    }

    public function updateNote(object $note): object
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

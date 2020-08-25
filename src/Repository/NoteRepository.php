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

    public function getNotesByPage($page, $perPage, $name, $description): array
    {
        $params = [
            'name' => '%' . $name . '%',
            'description' => '%' . $description . '%',
        ];
        $query = $this->getQueryNotesByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $params['name']);
        $statement->bindParam('description', $params['description']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination($query, $page, $perPage, $params, $total);
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

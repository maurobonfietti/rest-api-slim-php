<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Note;

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
            throw new \App\Exception\Note('Note not found.', 404);
        }

        return $note;
    }

    /**
     * @return array<string>
     */
    public function getNotes(): array
    {
        $query = 'SELECT * FROM `notes` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryNotesByPage(): string
    {
        return "
            SELECT *
            FROM `notes`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getNotesByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $description
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
            'description' => is_null($description) ? '' : $description,
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

    public function createNote(Note $note): Note
    {
        $query = '
            INSERT INTO `notes`
                (`name`, `description`)
            VALUES
                (:name, :description)
        ';
        $statement = $this->database->prepare($query);
        $name = $note->getName();
        $desc = $note->getDescription();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetNote((int) $this->database->lastInsertId());
    }

    public function updateNote(Note $note): Note
    {
        $query = '
            UPDATE `notes`
            SET `name` = :name, `description` = :description
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $note->getId();
        $name = $note->getName();
        $desc = $note->getDescription();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $desc);
        $statement->execute();

        return $this->checkAndGetNote((int) $id);
    }

    public function deleteNote(int $noteId): void
    {
        $query = 'DELETE FROM `notes` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $noteId);
        $statement->execute();
    }
}

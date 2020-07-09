<?php

declare(strict_types=1);

namespace App\Repository;

abstract class BaseRepository
{
    protected $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    protected function getDb(): \PDO
    {
        return $this->database;
    }

    protected function getResultByPage($query, $page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = $query . " LIMIT $perPage OFFSET $offset";
        $statement = $this->database->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }
}

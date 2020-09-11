<?php

declare(strict_types=1);

namespace App\Repository;

abstract class BaseRepository
{
    /** @var \PDO */
    protected $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    protected function getDb(): \PDO
    {
        return $this->database;
    }

    protected function getResultsWithPagination(
        string $query,
        int $page,
        int $perPage,
        array $params,
        int $total
    ): array {
        return [
            'pagination' => [
                'totalRows' => $total,
                'totalPages' => ceil($total / $perPage),
                'currentPage' => $page,
                'perPage' => $perPage,
            ],
            'data' => $this->getResultByPage($query, $page, $perPage, $params),
        ];
    }

    protected function getResultByPage(
        string $query,
        int $page,
        int $perPage,
        array $params
    ): array {
        $offset = ($page - 1) * $perPage;
        $query .= " LIMIT ${perPage} OFFSET ${offset}";
        $statement = $this->database->prepare($query);
        $statement->execute($params);

        return $statement->fetchAll();
    }
}

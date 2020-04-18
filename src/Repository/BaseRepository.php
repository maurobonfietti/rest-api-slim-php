<?php

declare(strict_types=1);

namespace App\Repository;

abstract class BaseRepository
{
    /**
     * @var \PDO
     */
    protected $database;

    protected function getDb(): \PDO
    {
        return $this->database;
    }
}

<?php

namespace App\Repository;

abstract class BaseRepository
{
    /**
     * @var \PDO $database
     */
    protected $database;

    protected function getDb(): \PDO
    {
        return $this->database;
    }
}

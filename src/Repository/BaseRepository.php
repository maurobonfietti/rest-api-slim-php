<?php

namespace App\Repository;

/**
 * Base Repository.
 */
abstract class BaseRepository
{
    /**
     * @var \PDO $database
     */
    protected $database;

    protected function getDb()
    {
        return $this->database;
    }
}

<?php

namespace App\Repository\Query;

/**
 * Notes Query.
 */
abstract class NoteQuery
{
    const GET_NOTE_QUERY = 'SELECT * FROM notes WHERE id=:id';
    const GET_NOTES_QUERY = 'SELECT * FROM notes ORDER BY id';
    const SEARCH_NOTES_QUERY = 'SELECT * FROM notes WHERE UPPER(name) LIKE :name ORDER BY id';
    const CREATE_NOTE_QUERY = 'INSERT INTO notes (name, email) VALUES (:name, :email)';
    const UPDATE_NOTE_QUERY = 'UPDATE notes SET name=:name, email=:email WHERE id=:id';
    const DELETE_NOTE_QUERY = 'DELETE FROM notes WHERE id=:id';
}

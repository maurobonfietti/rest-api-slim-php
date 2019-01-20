<?php

namespace App\Exception;

/**
 * Note Exception.
 */
class NoteException extends BaseException
{
    const NOTE_NOT_FOUND = 'Note not found.';
    const NOTE_NAME_NOT_FOUND = 'Note name not found.';
    const NOTE_NAME_REQUIRED = 'The field "name" is required.';
    const NOTE_INFO_REQUIRED = 'Enter the data to update the note.';
    const NOTE_NAME_INVALID = 'Invalid name.';
}

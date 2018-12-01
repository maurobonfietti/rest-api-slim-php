<?php

namespace App\Exception;

/**
 * Note Exception.
 */
class NoteException extends BaseException
{
    const NOTE_NOT_FOUND = 'Not found.';
    const NOTE_NAME_NOT_FOUND = 'Not found';
    const NOTE_NAME_REQUIRED = 'Fields required.';
    const NOTE_INFO_REQUIRED = 'Enter the data to update the note.';
    const NOTE_NAME_INVALID = 'Error in note.';
    const NOTE_EMAIL_INVALID = 'Error email.';

    /**
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

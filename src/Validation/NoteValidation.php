<?php

namespace App\Validation;

use App\Exception\NoteException;

/**
 * Note Validation.
 */
abstract class NoteValidation extends BaseValidation
{
    /**
     * Validate and sanitize input data when create new note.
     *
     * @param array $input
     * @return array
     * @throws \Exception
     */
    public static function validateInputOnCreateNote($input)
    {
        if (!isset($input['name'])) {
            throw new NoteException(NoteException::NOTE_NAME_REQUIRED, 400);
        }
        $name = self::validateName($input['name']);
        $email = null;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }

    /**
     * @param array $input
     * @param object $note
     * @return string
     */
    public static function validateNameOnUpdateNote($input, $note)
    {
        $name = $note->name;
        if (isset($input['name'])) {
            $name = self::validateName($input['name']);
        }

        return $name;
    }

    /**
     * @param array $input
     * @param object $note
     * @return string
     */
    public static function validateEmailOnUpdateNote($input, $note)
    {
        $email = $note->email;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }

        return $email;
    }
}

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
        $name = self::validateNoteName($input['name']);
        $description = null;
        if (isset($input['description'])) {
            $description = $input['description'];
        }

        return ['name' => $name, 'description' => $description];
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
            $name = self::validateNoteName($input['name']);
        }

        return $name;
    }

    /**
     * @param array $input
     * @param object $note
     * @return string
     */
    public static function validateDescriptionOnUpdateNote($input, $note)
    {
        $description = $note->description;
        if (isset($input['description'])) {
            $description = $input['description'];
        }

        return $description;
    }
}

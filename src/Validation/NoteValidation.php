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
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new NoteException(NoteException::NOTE_NAME_REQUIRED, 400);
        }
        $name = self::validateNoteName($data->name);
        $description = null;
        if (isset($data->description)) {
            $description = $data->description;
        }
        $note = new \stdClass();
        $note->name = $name;
        $note->description = $description;

        return $note;
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

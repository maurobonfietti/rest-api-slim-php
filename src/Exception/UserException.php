<?php

namespace App\Exception;

/**
 * User Exception.
 */
class UserException extends BaseException
{
    const USER_NOT_FOUND = 'El usuario solicitado no existe.';
    const USER_NAME_NOT_FOUND = 'No se encontraron usuarios con ese nombre.';
    const USER_NAME_REQUIRED = 'Ingrese el nombre del usuario.';
    const USER_INFO_REQUIRED = 'Ingrese los datos a actualizar del usuario.';
    const USER_NAME_INVALID = 'El nombre ingresado es incorrecto.';
    const USER_EMAIL_INVALID = 'El email ingresado es incorrecto.';

    /**
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = '', $code = null, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

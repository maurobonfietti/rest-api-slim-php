<?php

namespace App\Controller;

use Respect\Validation\Validator as v;

/**
 * Base Class.
 */
abstract class Base
{
    const API_VERSION = '17.04';

    const USER_NOT_FOUND = 'El usuario solicitado no existe.';
    const USER_NAME_NOT_FOUND = 'No se encontraron usuarios con ese nombre.';
    const USER_NAME_REQUIRED = 'Ingrese el nombre del usuario.';
    const USER_INFO_REQUIRED = 'Ingrese los datos a actualizar del usuario.';
    const USER_DELETED = 'El usuario fue eliminado correctamente.';
    const USER_NAME_INVALID = 'El nombre ingresado no es correcto.';
    const USER_EMAIL_INVALID = 'El email ingresado no es correcto.';

    const TASK_NOT_FOUND = 'La tarea solicitada no existe.';
    const TASK_NAME_NOT_FOUND = 'No se encontraron tareas con ese nombre.';
    const TASK_NAME_REQUIRED = 'Ingrese el nombre de la tarea.';
    const TASK_INFO_REQUIRED = 'Ingrese los datos a actualizar de la tarea.';
    const TASK_DELETED = 'La tarea fue eliminada correctamente.';

    protected $database;
    protected $request;
    protected $response;
    protected $args;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    protected function setParams($request, $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    /**
     * Send response with json as standard format.
     *
     * @param string $status
     * @param mixed $message
     * @param int $code
     * @return array $response
     */
    protected function jsonResponse($status, $message, $code)
    {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $this->response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

    /**
     * Validate and sanitize a user input.
     *
     * @param array $input
     * @return string
     * @throws \Exception
     */
    protected function validateInput($input)
    {
        if (!isset($input['name'])) {
            throw new \Exception(self::USER_NAME_REQUIRED, 400);
        }
        $name = $input['name'];
        $usernameValidator = v::alnum()->length(1, 100);
        if (!$usernameValidator->validate($name)) {
            throw new \Exception(self::USER_NAME_INVALID, 400);
        }
        $email = null;
        if (isset($input['email'])) {
            $email = $this->validateEmail($input['email']);
        }
        $data = [
            'name' => $name,
            'email' => $email,
        ];
        return $data;
    }

    /**
     * Validate and sanitize a email address.
     *
     * @param string $emailValue
     * @return string
     * @throws \Exception
     */
    protected function validateEmail($emailValue)
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (!v::email()->validate($email)) {
            throw new \Exception(self::USER_EMAIL_INVALID, 400);
        }

        return $email;
    }
}

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
    const USER_NAME_INVALID = 'El nombre ingresado es incorrecto.';
    const USER_EMAIL_INVALID = 'El email ingresado es incorrecto.';

    const TASK_NOT_FOUND = 'La tarea solicitada no existe.';
    const TASK_NAME_NOT_FOUND = 'No se encontraron tareas con ese nombre.';
    const TASK_NAME_REQUIRED = 'Ingrese el nombre de la tarea.';
    const TASK_INFO_REQUIRED = 'Ingrese los datos a actualizar de la tarea.';
    const TASK_DELETED = 'La tarea fue eliminada correctamente.';
    const TASK_STATUS_INVALID = 'El estado ingresado es incorrecto.';

    protected $logger;
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
        $info = [
            'method' => $this->request->getAttribute('route')->getMethods(),
            'path' => $this->request->getUri()->getPath(),
            'input' => $this->request->getParsedBody(),
            'args' => $this->args,
        ];
        $this->logger->info(json_encode($info));
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
     * Validate and sanitize input data when create new user.
     *
     * @param array $input
     * @return string
     * @throws \Exception
     */
    protected function validateInputOnCreateUser($input)
    {
        if (!isset($input['name'])) {
            throw new \Exception(self::USER_NAME_REQUIRED, 400);
        }
        $name = $this->validateName($input['name']);
        $email = null;
        if (isset($input['email'])) {
            $email = $this->validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }

    /**
     * Validate and sanitize input data when update a user.
     *
     * @param array $input
     * @param object $user
     * @return string
     * @throws \Exception
     */
    protected function validateInputOnUpdateUser($input, $user)
    {
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new \Exception(self::USER_INFO_REQUIRED, 400);
        }
        $name = $user->name;
        if (isset($input['name'])) {
            $name = $this->validateName($input['name']);
        }
        $email = $user->email;
        if (isset($input['email'])) {
            $email = $this->validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }

    /**
     * Validate and sanitize a username.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected function validateName($name)
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new \Exception(self::USER_NAME_INVALID, 400);
        }

        return $name;
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

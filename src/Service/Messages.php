<?php

namespace App\Service;

/**
 * Default Messages.
 */
abstract class Messages
{
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
    const TASK_NAME_INVALID = 'La tarea ingresada es incorrecta.';
    const TASK_STATUS_INVALID = 'El estado ingresado es incorrecto.';
}

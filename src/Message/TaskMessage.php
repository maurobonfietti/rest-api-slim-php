<?php

namespace App\Message;

/**
 * Task Message.
 */
abstract class TaskMessage
{
    const TASK_NOT_FOUND      = 'La tarea solicitada no existe.';
    const TASK_NAME_NOT_FOUND = 'No se encontraron tareas con ese nombre.';
    const TASK_NAME_REQUIRED  = 'Ingrese el nombre de la tarea.';
    const TASK_INFO_REQUIRED  = 'Ingrese los datos a actualizar de la tarea.';
    const TASK_DELETED        = 'La tarea fue eliminada correctamente.';
    const TASK_NAME_INVALID   = 'La tarea ingresada es incorrecta.';
    const TASK_STATUS_INVALID = 'El estado ingresado es incorrecto.';
}

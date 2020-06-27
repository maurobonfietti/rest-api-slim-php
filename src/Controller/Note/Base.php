<?php

declare(strict_types=1);

namespace App\Controller\Note;

use App\Controller\BaseController;
use App\Service\Note\NoteService;

abstract class Base extends BaseController
{
    protected function getNoteService(): NoteService
    {
        return $this->container->get('note_service');
    }
}

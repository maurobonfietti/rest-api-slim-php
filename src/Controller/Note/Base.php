<?php

declare(strict_types=1);

namespace App\Controller\Note;

use App\Controller\BaseController;
use App\Service\Note\NoteService;
use App\Service\Note;

abstract class Base extends BaseController
{
    protected function getNoteService(): NoteService
    {
        return $this->container->get('note_service');
    }

    protected function getServiceCreateNote(): Note\Create
    {
        return $this->container->get('create_note_service');
    }

    protected function getServiceUpdateNote(): Note\Update
    {
        return $this->container->get('update_note_service');
    }
}

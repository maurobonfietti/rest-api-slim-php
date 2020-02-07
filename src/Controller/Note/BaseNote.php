<?php declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Container;
use App\Controller\BaseController;
use App\Service\NoteService;
use App\Service\Note\CreateNoteService;
use App\Service\Note\DeleteNoteService;
use App\Service\Note\GetAllNoteService;
use App\Service\Note\GetOneNoteService;
use App\Service\Note\SearchNoteService;
use App\Service\Note\UpdateNoteService;

abstract class BaseNote extends BaseController
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getNoteService(): NoteService
    {
        return $this->container->get('note_service');
    }

    protected function createNoteService(): CreateNoteService
    {
        return $this->container->get('create_note_service');
    }

    protected function deleteNoteService(): DeleteNoteService
    {
        return $this->container->get('delete_note_service');
    }

    protected function getAllNoteService(): GetAllNoteService
    {
        return $this->container->get('get_all_note_service');
    }

    protected function getOneNoteService(): GetOneNoteService
    {
        return $this->container->get('get_one_note_service');
    }

    protected function SearchNoteService(): SearchNoteService
    {
        return $this->container->get('search_note_service');
    }

    protected function UpdateNoteService(): UpdateNoteService
    {
        return $this->container->get('update_note_service');
    }
}

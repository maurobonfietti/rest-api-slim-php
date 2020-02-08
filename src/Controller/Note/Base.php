<?php declare(strict_types=1);

namespace App\Controller\Note;

use App\Controller\BaseController;
use App\Service\Note\Create;
use App\Service\Note\Delete;
use App\Service\Note\GetAll;
use App\Service\Note\GetOne;
use App\Service\Note\Search;
use App\Service\Note\Update;
use Slim\Container;

abstract class Base extends BaseController
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function createNoteService(): Create
    {
        return $this->container->get('create_note_service');
    }

    protected function deleteNoteService(): Delete
    {
        return $this->container->get('delete_note_service');
    }

    protected function getAllNoteService(): GetAll
    {
        return $this->container->get('get_all_note_service');
    }

    protected function getOneNoteService(): GetOne
    {
        return $this->container->get('get_one_note_service');
    }

    protected function SearchNoteService(): Search
    {
        return $this->container->get('search_note_service');
    }

    protected function UpdateNoteService(): Update
    {
        return $this->container->get('update_note_service');
    }
}

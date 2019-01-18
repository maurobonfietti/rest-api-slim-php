<?php

namespace App\Controller\Note;

use App\Controller\BaseController;
use App\Service\NoteService;
use Slim\Container;

/**
 * Base Note Controller.
 */
abstract class BaseNote extends BaseController
{
    const KEY = 'rest-api-slim-php:note:';

    /**
     * @var NoteService
     */
    protected $noteService;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->logger = $container->get('logger');
    }

    /**
     * @return NoteService
     */
    protected function getNoteService()
    {
        return $this->container->get('note_service');
    }
}

<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Service\BaseService;
use App\Service\RedisService;
use App\Repository\NoteRepository;

abstract class BaseNoteService extends BaseService
{
    const REDIS_KEY = 'note:%s';

    /**
     * @var NoteRepository 
     */
    protected $noteRepository;

    /**
     * @var RedisService 
     */
    protected $redisService;

    public function __construct(NoteRepository $noteRepository, RedisService $redisService)
    {
        $this->noteRepository = $noteRepository;
        $this->redisService = $redisService;
    }

    public function getOneFromDb(int $noteId)
    {
        return $this->noteRepository->checkAndGetNote($noteId);
    }

    public function saveInCache($id, $note)
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $note);
    }

    public function deleteFromCache($noteId)
    {
        $redisKey = sprintf(self::REDIS_KEY, $noteId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del($key);
    }
}

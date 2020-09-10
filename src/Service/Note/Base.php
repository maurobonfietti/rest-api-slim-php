<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Exception\Note;
use App\Repository\NoteRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'note:%s';

    /** @var NoteRepository */
    protected $noteRepository;

    /** @var RedisService */
    protected $redisService;

    public function __construct(
        NoteRepository $noteRepository,
        RedisService $redisService
    ) {
        $this->noteRepository = $noteRepository;
        $this->redisService = $redisService;
    }

    protected static function validateNoteName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new Note('The name of the note is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $noteId): object
    {
        $redisKey = sprintf(self::REDIS_KEY, $noteId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $note = $this->redisService->get($key);
        } else {
            $note = $this->getOneFromDb($noteId)->getData();
            $this->redisService->setex($key, $note);
        }

        return $note;
    }

    protected function getOneFromDb(int $noteId): \App\Entity\Note
    {
        return $this->noteRepository->checkAndGetNote($noteId);
    }

    protected function saveInCache(int $id, object $note): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $id);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->setex($key, $note);
    }

    protected function deleteFromCache(int $noteId): void
    {
        $redisKey = sprintf(self::REDIS_KEY, $noteId);
        $key = $this->redisService->generateKey($redisKey);
        $this->redisService->del([$key]);
    }
}

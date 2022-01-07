<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Service\BaseService;
use App\Service\RedisService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{
    private const REDIS_KEY = 'note:%s';

    public function __construct(
        protected NoteRepository $noteRepository,
        protected RedisService $redisService
    ) {
    }

    protected static function validateNoteName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new \App\Exception\Note('The name of the note is invalid.', 400);
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
            $note = $this->getOneFromDb($noteId)->toJson();
            $this->redisService->setex($key, $note);
        }

        return $note;
    }

    protected function getOneFromDb(int $noteId): Note
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

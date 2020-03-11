<?php

declare(strict_types=1);

namespace App\Service\Note;

class GetOne extends BaseNoteService
{
    public function getOne(int $noteId)
    {
        if ($this->useRedisCache() === true) {
            $note = $this->getOneFromCache($noteId);
        } else {
            $note = $this->checkAndGetNote($noteId);
        }

        return $note;
    }

    public function getOneFromCache(int $noteId)
    {
        $key = $this->redisService->generateKey("note:$noteId");
        if ($this->redisService->exists($key)) {
            $note = $this->redisService->get($key);
        } else {
            $note = $this->checkAndGetNote($noteId);
            $this->redisService->setex($key, $note);
        }

        return $note;
    }
}

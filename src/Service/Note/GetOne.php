<?php

declare(strict_types=1);

namespace App\Service\Note;

class GetOne extends BaseNoteService
{
    public function getOne(int $noteId)
    {
        if (self::isRedisEnabled() === true) {
            $note = $this->getOneFromCache($noteId);
        } else {
            $note = $this->getOneFromDb($noteId);
        }

        return $note;
    }

    public function getOneFromCache(int $noteId)
    {
        $redisKey = sprintf(self::REDIS_KEY, $noteId);
        $key = $this->redisService->generateKey($redisKey);
        if ($this->redisService->exists($key)) {
            $note = $this->redisService->get($key);
        } else {
            $note = $this->getOneFromDb($noteId);
            $this->redisService->setex($key, $note);
        }

        return $note;
    }
}

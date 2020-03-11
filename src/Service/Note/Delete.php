<?php

declare(strict_types=1);

namespace App\Service\Note;

class Delete extends BaseNoteService
{
    public function delete(int $noteId)
    {
        $this->checkAndGetNote($noteId);
        $this->noteRepository->deleteNote($noteId);
        if ($this->useRedisCache() === true) {
            $redisKey = sprintf(self::REDIS_KEY, $noteId);
            $key = $this->redisService->generateKey($redisKey);
            $this->redisService->del($key);
        }
    }
}

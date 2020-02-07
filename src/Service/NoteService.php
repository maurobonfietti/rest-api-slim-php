<?php declare(strict_types=1);

namespace App\Service;

use App\Repository\NoteRepository;

class NoteService extends BaseService
{
    protected $noteRepository;

    protected $redisService;

    public function __construct(NoteRepository $noteRepository, RedisService $redisService)
    {
        $this->noteRepository = $noteRepository;
        $this->redisService = $redisService;
    }
}

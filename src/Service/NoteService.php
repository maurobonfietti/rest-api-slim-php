<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\NoteException;
use App\Repository\NoteRepository;

class NoteService extends BaseService
{
    const REDIS_KEY = 'note:%s';

    protected $noteRepository;

    protected $redisService;

    public function __construct(NoteRepository $noteRepository, RedisService $redisService)
    {
        $this->noteRepository = $noteRepository;
        $this->redisService = $redisService;
    }

    public function checkAndGetNote(int $noteId)
    {
        return $this->noteRepository->checkAndGetNote($noteId);
    }

//    public function getNotes(): array
//    {
//        return $this->noteRepository->getNotes();
//    }

//    public function getNote(int $noteId)
//    {
//        $key = $this->redisService->generateKey("note:$noteId");
//        if ($this->redisService->exists($key)) {
//            $note = $this->redisService->get($key);
//        } else {
//            $note = $this->checkAndGetNote($noteId);
//            $this->redisService->setex($key, $note);
//        }
//
//        return $note;
//    }

//    public function searchNotes(string $notesName): array
//    {
//        return $this->noteRepository->searchNotes($notesName);
//    }

//    public function createNote($input)
//    {
//        $note = new \stdClass();
//        $data = json_decode(json_encode($input), false);
//        if (!isset($data->name)) {
//            throw new NoteException('Invalid data: name is required.', 400);
//        }
//        $note->name = self::validateNoteName($data->name);
//        $note->description = null;
//        if (isset($data->description)) {
//            $note->description = $data->description;
//        }
//        $notes = $this->noteRepository->createNote($note);
//        $redisKey = sprintf(self::REDIS_KEY, $notes->id);
//        $key = $this->redisService->generateKey($redisKey);
//        $this->redisService->setex($key, $notes);
//
//        return $notes;
//    }

//    public function updateNote($input, int $noteId)
//    {
//        $note = $this->checkAndGetNote($noteId);
//        $data = json_decode(json_encode($input), false);
//        if (!isset($data->name) && !isset($data->description)) {
//            throw new NoteException('Enter the data to update the note.', 400);
//        }
//        if (isset($data->name)) {
//            $note->name = self::validateNoteName($data->name);
//        }
//        if (isset($data->description)) {
//            $note->description = $data->description;
//        }
//        $notes = $this->noteRepository->updateNote($note);
//        $redisKey = sprintf(self::REDIS_KEY, $notes->id);
//        $key = $this->redisService->generateKey($redisKey);
//        $this->redisService->setex($key, $notes);
//
//        return $notes;
//    }

//    public function deleteNote(int $noteId)
//    {
//        $this->checkAndGetNote($noteId);
//        $this->noteRepository->deleteNote($noteId);
//        $redisKey = sprintf(self::REDIS_KEY, $noteId);
//        $key = $this->redisService->generateKey($redisKey);
//        $this->redisService->del($key);
//    }
}

<?php

declare(strict_types=1);

namespace App\Service\Note;

final class Update extends Base
{
    public function update(array $input, int $noteId): object
    {
        $note = $this->getOneFromDb($noteId);
        $data = json_decode(json_encode($input), false);
        if (isset($data->name)) {
            $note->name = self::validateNoteName($data->name);
        }
        if (isset($data->description)) {
            $note->description = $data->description;
        }
        $notes = $this->noteRepository->updateNote($note);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($notes->id, $notes);
        }

        return $notes;
    }
}

<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Exception\Note;

final class Create extends Base
{
    public function create(array $input): object
    {
        $data = json_decode(json_encode($input), false);
        if (! isset($data->name)) {
            throw new Note('Invalid data: name is required.', 400);
        }
        self::validateNoteName($data->name);
        $data->description = $data->description ?? null;
        $note = $this->noteRepository->createNote($data);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($note->id, $note);
        }

        return $note;
    }
}

<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Entity\Note;
use App\Exception\Note as NoteException;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new NoteException('Invalid data: name is required.', 400);
        }
        $mynote = new Note();
        $mynote->updateName(self::validateNoteName($data->name));
        $description = $data->description ?? null;
        $mynote->updateDescription($description);
        /** @var Note $note */
        $note = $this->noteRepository->createNote($mynote);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($note->getId(), $note->toJson());
        }

        return $note->toJson();
    }
}

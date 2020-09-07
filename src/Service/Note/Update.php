<?php

declare(strict_types=1);

namespace App\Service\Note;

final class Update extends Base
{
    public function update(array $input, int $noteId): object
    {
        $note = $this->getOneFromDb($noteId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
//            $note->name = self::validateNoteName($data->name);
            $note->updateName(self::validateNoteName($data->name));
        }
        if (isset($data->description)) {
            $note->updateDescription($data->description);
        }
        /** @var \App\Entity\Note $notes */
        $notes = $this->noteRepository->updateNote($note);
//        $notes = $this->noteRepository->updateNote($note)->getData2();
        if (self::isRedisEnabled() === true) {
//            $this->saveInCache($notes->id, $notes);
            $this->saveInCache($notes->getId(), $notes->getData2());
        }

        return $notes->getData2();
//        return $notes;
    }
}

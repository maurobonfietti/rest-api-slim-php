<?php

declare(strict_types=1);

namespace App\Service\Note;

use App\Entity\Note;

final class Update extends Base
{
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $noteId): object
    {
        $note = $this->getOneFromDb($noteId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $note->updateName(self::validateNoteName($data->name));
        }
        if (isset($data->description)) {
            $note->updateDescription($data->description);
        }
        /** @var Note $notes */
        $notes = $this->noteRepository->updateNote($note);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($notes->getId(), $notes->toJson());
        }

        return $notes->toJson();
    }
}

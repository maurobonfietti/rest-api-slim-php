<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Exception\User;

final class Update extends Base
{
    public function update(array $input, int $userId): object
    {
        $user = $this->validateUserData($input, $userId);
        /** @var \App\Entity\User $users */
        $users = $this->userRepository->update($user);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache((int) $users->getId(), $users->getData());
        }

        return $users->getData();
    }

    public function validateUserData(array $input, int $userId): object
    {
        $user = $this->getUserFromDb($userId);
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name) && ! isset($data->email)) {
            throw new User('Enter the data to update the user.', 400);
        }
        if (isset($data->name)) {
            $user->updateName(self::validateUserName($data->name));
        }
        if (isset($data->email)) {
            $user->updateEmail(self::validateEmail($data->email));
        }

        return $user;
    }
}

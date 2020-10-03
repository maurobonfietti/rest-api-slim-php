<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Exception\User;

final class Create extends Base
{
    public function create(array $input): object
    {
        $data = $this->validateUserData($input);
        /** @var \App\Entity\User $user */
        $user = $this->userRepository->create($data);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache((int) $user->getId(), $user->getData());
        }

        return $user->getData();
    }

    private function validateUserData(array $input): \App\Entity\User
    {
        $user = json_decode((string) json_encode($input), false);
        if (! isset($user->name)) {
            throw new User('The field "name" is required.', 400);
        }
        if (! isset($user->email)) {
            throw new User('The field "email" is required.', 400);
        }
        if (! isset($user->password)) {
            throw new User('The field "password" is required.', 400);
        }
        $myuser = new \App\Entity\User();
        $myuser->updateName(self::validateUserName($user->name));
        $myuser->updateEmail(self::validateEmail($user->email));
        $myuser->updatePassword(hash('sha512', $user->password));
        $this->userRepository->checkUserByEmail($user->email);

        return $myuser;
    }
}

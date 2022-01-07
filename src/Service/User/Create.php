<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;

final class Create extends Base
{
    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = $this->validateUserData($input);
        /** @var User $user */
        $user = $this->userRepository->create($data);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache($user->getId(), $user->toJson());
        }

        return $user->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validateUserData(array $input): User
    {
        $user = json_decode((string) json_encode($input), false);
        if (! isset($user->name)) {
            throw new \App\Exception\User('The field "name" is required.', 400);
        }
        if (! isset($user->email)) {
            throw new \App\Exception\User('The field "email" is required.', 400);
        }
        if (! isset($user->password)) {
            throw new \App\Exception\User('The field "password" is required.', 400);
        }
        $myuser = new User();
        $myuser->updateName(self::validateUserName($user->name));
        $myuser->updateEmail(self::validateEmail($user->email));
        $myuser->updatePassword(hash('sha512', $user->password));
        $this->userRepository->checkUserByEmail($user->email);

        return $myuser;
    }
}

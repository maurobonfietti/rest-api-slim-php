<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Exception\User;
use Firebase\JWT\JWT;

final class UserService extends Base
{
    public function getAll(): array
    {
        return $this->userRepository->getAll();
    }

    public function getOne(int $userId): object
    {
        if (self::isRedisEnabled() === true) {
            $user = $this->getUserFromCache($userId);
        } else {
            $user = $this->getUserFromDb($userId);
        }

        return $user;
    }

    public function search(string $usersName): array
    {
        return $this->userRepository->search($usersName);
    }

    public function create(array $input): object
    {
        $data = $this->validateUserData($input);
        $user = $this->userRepository->create($data);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache((int) $user->id, $user);
        }

        return $user;
    }

    public function update(array $input, int $userId): object
    {
        $user = $this->getUserFromDb($userId);
        $data = json_decode(json_encode($input), false);
        if (! isset($data->name) && ! isset($data->email)) {
            throw new User('Enter the data to update the user.', 400);
        }
        if (isset($data->name)) {
            $user->name = self::validateUserName($data->name);
        }
        if (isset($data->email)) {
            $user->email = self::validateEmail($data->email);
        }
        $users = $this->userRepository->update($user);
        if (self::isRedisEnabled() === true) {
            $this->saveInCache((int) $users->id, $users);
        }

        return $users;
    }

    public function delete(int $userId): void
    {
        $this->getUserFromDb($userId);
        $this->userRepository->deleteUserTasks($userId);
        $this->userRepository->delete($userId);
        if (self::isRedisEnabled() === true) {
            $this->deleteFromCache($userId);
        }
    }

    public function login(array $input): string
    {
        $data = json_decode(json_encode($input), false);
        if (! isset($data->email)) {
            throw new User('The field "email" is required.', 400);
        }
        if (! isset($data->password)) {
            throw new User('The field "password" is required.', 400);
        }
        $password = hash('sha512', $data->password);
        $user = $this->userRepository->loginUser($data->email, $password);
        $token = [
            'sub' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'iat' => time(),
            'exp' => time() + (7 * 24 * 60 * 60),
        ];

        return JWT::encode($token, getenv('SECRET_KEY'));
    }

    private function validateUserData(array $input): object
    {
        $user = json_decode(json_encode($input), false);
        if (! isset($user->name)) {
            throw new User('The field "name" is required.', 400);
        }
        if (! isset($user->email)) {
            throw new User('The field "email" is required.', 400);
        }
        if (! isset($user->password)) {
            throw new User('The field "password" is required.', 400);
        }
        $user->name = self::validateUserName($user->name);
        $user->email = self::validateEmail($user->email);
        $user->password = hash('sha512', $user->password);
        $this->userRepository->checkUserByEmail($user->email);

        return $user;
    }
}

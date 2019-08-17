<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\UserException;
use App\Repository\UserRepository;
use \Firebase\JWT\JWT;

class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    protected $redisService;

    public function __construct(UserRepository $userRepository, RedisService $redisService)
    {
        $this->userRepository = $userRepository;
        $this->redisService = $redisService;
    }

    protected function checkAndGetUser(int $userId)
    {
        return $this->userRepository->checkAndGetUser($userId);
    }

    public function getUsers(): array
    {
        return $this->userRepository->getUsers();
    }

    public function getUser(int $userId)
    {
        $key = "user:$userId";
        if ($this->useRedis() === true && $this->redisService->exists($key)) {
            $data = $this->redisService->get($key);
            $user = json_decode(json_encode($data), false);
        } else {
            $user = $this->checkAndGetUser($userId);
            $this->redisService->setex($key, $user);
        }

        return $user;
    }

    public function searchUsers(string $usersName): array
    {
        return $this->userRepository->searchUsers($usersName);
    }

    public function createUser($input)
    {
        $user = new \stdClass();
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name)) {
            throw new UserException('The field "name" is required.', 400);
        }
        if (!isset($data->email)) {
            throw new UserException('The field "email" is required.', 400);
        }
        if (!isset($data->password)) {
            throw new UserException('The field "password" is required.', 400);
        }
        $user->name = self::validateUserName($data->name);
        $user->email = self::validateEmail($data->email);
        $user->password = hash('sha512', $data->password);
        $this->userRepository->checkUserByEmail($user->email);
        $users = $this->userRepository->createUser($user);
        if ($this->useRedis() === true) {
            $key = "user:" . $users->id;
            $this->redisService->setex($key, $users);
        }

        return $users;
    }

    public function updateUser(array $input, int $userId)
    {
        $user = $this->checkAndGetUser($userId);
        $data = json_decode(json_encode($input), false);
        if (!isset($data->name) && !isset($data->email)) {
            throw new UserException('Enter the data to update the user.', 400);
        }
        if (isset($data->name)) {
            $user->name = self::validateUserName($data->name);
        }
        if (isset($data->email)) {
            $user->email = self::validateEmail($data->email);
        }
        $users = $this->userRepository->updateUser($user);
        if ($this->useRedis() === true) {
            $key = "user:" . $users->id;
            $this->redisService->setex($key, $users);
        }

        return $users;
    }

    public function deleteUser(int $userId): string
    {
        $this->checkAndGetUser($userId);
        $this->userRepository->deleteUserTasks($userId);
        $data = $this->userRepository->deleteUser($userId);
        if ($this->useRedis() === true) {
            $key = "user:" . $userId;
            $this->redisService->del($key);
        }

        return $data;
    }

    public function loginUser(?array $input): string
    {
        $data = json_decode(json_encode($input), false);
        if (!isset($data->email)) {
            throw new UserException('The field "email" is required.', 400);
        }
        if (!isset($data->password)) {
            throw new UserException('The field "password" is required.', 400);
        }
        $password = hash('sha512', $data->password);
        $user = $this->userRepository->loginUser($data->email, $password);
        $token = array(
            'sub' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'iat' => time(),
            'exp' => time() + (7 * 24 * 60 * 60),
        );

        return JWT::encode($token, getenv('SECRET_KEY'));
    }
}

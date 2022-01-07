<?php

declare(strict_types=1);

namespace App\Service\User;

final class Find extends Base
{
    /**
     * @return array<string>
     */
    public function getUsersByPage(
        int $page,
        int $perPage,
        ?string $name,
        ?string $email
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->userRepository->getUsersByPage(
            $page,
            $perPage,
            $name,
            $email
        );
    }

    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->userRepository->getAll();
    }

    public function getOne(int $userId): object
    {
        if (self::isRedisEnabled() === true) {
            $user = $this->getUserFromCache($userId);
        } else {
            $user = $this->getUserFromDb($userId)->toJson();
        }

        return $user;
    }
}

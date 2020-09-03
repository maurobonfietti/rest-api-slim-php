<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Exception\User;
use App\Service\User\UserService;

abstract class Base extends BaseController
{
    protected function getUserService(): UserService
    {
        return $this->container->get('user_service');
    }

    protected function checkUserPermissions(int $userId, int $userIdLogged): void
    {
        if ($userId !== $userIdLogged) {
            throw new User('User permission failed.', 400);
        }
    }

    protected function getAndValidateUserId(array $input): int
    {
        if (isset($input['decoded']) && isset($input['decoded']->sub)) {
            return (int) $input['decoded']->sub;
        }

        throw new User('Invalid user. Permission failed.', 400);
    }
}

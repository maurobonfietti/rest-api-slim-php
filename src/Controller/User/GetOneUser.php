<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOneUser extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        if ($this->useRedis() === true) {
            $user = $this->getUserFromCache($this->args['id']);
        } else {
            $user = $this->getUserService()->getUser($this->args['id']);
        }

        return $this->jsonResponse('success', $user, 200);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    private function getUserFromCache(int $userId)
    {
        $user = $this->getFromCache($userId);
        if ($user === null) {
            $user = $this->getUserService()->getUser($userId);
            $this->saveInCache($userId, $user);
        }

        return $user;
    }
}

<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get One User Controller.
 */
class GetOneUser extends BaseUser
{
    /**
     * Get one user by id.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        if ($this->args['id'] != $input['decoded']->sub) {
            throw new \Exception('User perms failed.', 400);
        }
        if ($this->useRedis() === true) {
            $user = $this->getUserFromCache($this->args['id']);
        } else {
            $user = $this->getUserService()->getUser($this->args['id']);
        }

        return $this->jsonResponse('success', $user, 200);
    }

    /**
     * @param int $userId
     * @return object
     */
    private function getUserFromCache($userId)
    {
        $user = $this->getFromCache($userId);
        if ($user === null) {
            $user = $this->getUserService()->getUser($userId);
            $this->saveInCache($userId, $user);
        }

        return $user;
    }
}

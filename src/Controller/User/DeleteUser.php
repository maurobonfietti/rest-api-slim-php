<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Delete User Controller.
 */
class DeleteUser extends BaseUser
{
    /**
     * Delete a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $this->checkUserPermissions();
        $user = $this->getUserService()->deleteUser($this->args['id']);
        if ($this->useRedis() === true) {
            $this->deleteFromCache($this->args['id']);
        }

        return $this->jsonResponse('success', $user, 204);
    }
}

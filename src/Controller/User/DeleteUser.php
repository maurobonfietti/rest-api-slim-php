<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class DeleteUser extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
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

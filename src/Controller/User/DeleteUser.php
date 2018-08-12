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
        $result = $this->getUserService()->deleteUser($this->args['id']);

//        $client = new \Predis\Client();
//        $key = 'api-rest-slimphp:user:'.$this->args['id'];
//        $client->del($key);

        return $this->jsonResponse('success', $result, 200);
    }
}

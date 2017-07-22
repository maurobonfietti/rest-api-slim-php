<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Get All Users Controller.
 */
class GetAllUsers extends BaseUser
{
    /**
     * Get all users.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $result = $this->getUserService()->getUsers();

        return $this->jsonResponse('success', $result, 200);
    }
}

<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Search Users Controller.
 */
class SearchUsers extends BaseUser
{
    /**
     * Search users by name.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $result = $this->getUserService()->searchUsers($this->args['query']);

        return $this->jsonResponse('success', $result, 200);
    }
}

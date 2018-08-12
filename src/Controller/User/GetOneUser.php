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
//        $result = $this->getFromCache($this->args['id']);
//        if (is_null($result)) {
            $result = $this->getUserService()->getUser($this->args['id']);
//            $this->saveInCache($this->args['id'], $result);
//        }

        return $this->jsonResponse('success', $result, 200);
    }
}

<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Create User Controller.
 */
class CreateUser extends BaseUser
{
    /**
     * Create a user.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $input = $this->request->getParsedBody();
            $result = $this->getUserService()->createUser($input);

            return $this->jsonResponse('success', $result, 201);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

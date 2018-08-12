<?php

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Update User Controller.
 */
class UpdateUser extends BaseUser
{
    /**
     * Update a user.
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
        $result = $this->getUserService()->updateUser($input, $this->args['id']);

        $client = new \Predis\Client();
        $key = 'api-rest-slimphp:user:'.$this->args['id'];
        $client->set($key, json_encode($result));

        return $this->jsonResponse('success', $result, 200);
    }
}

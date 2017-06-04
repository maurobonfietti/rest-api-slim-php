<?php

namespace App\Controller\User;

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
     * @return array
     */
    public function getUsers($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $result = $this->getUserService()->getUsers();

        return $this->jsonResponse('success', $result, 200);
    }
}

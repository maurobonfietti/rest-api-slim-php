<?php

namespace App\Controller\User;

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
     * @return array
     */
    public function getUser($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getUserService()->getUser($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

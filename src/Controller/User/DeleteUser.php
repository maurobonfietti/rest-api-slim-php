<?php

namespace App\Controller\User;

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
     * @return array
     */
    public function deleteUser($request, $response, $args)
    {
        try {
            $this->setParams($request, $response, $args);
            $result = $this->getUserService()->deleteUser($this->args['id']);

            return $this->jsonResponse('success', $result, 200);
        } catch (\Exception $ex) {
            return $this->jsonResponse('error', $ex->getMessage(), $ex->getCode());
        }
    }
}

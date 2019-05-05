<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class UpdateUser extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $this->checkUserPermissions();
        $user = $this->getUserService()->updateUser($input, (int) $this->args['id']);
        if ($this->useRedis() === true) {
            $this->saveInCache((int) $this->args['id'], $user);
        }

        return $this->jsonResponse('success', $user, 200);
    }
}

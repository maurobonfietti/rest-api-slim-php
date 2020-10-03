<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $userIdLogged = $this->getAndValidateUserId($input);
        $this->checkUserPermissions((int) $args['id'], (int) $userIdLogged);
        $user = $this->getUpdateUserService()->update($input, (int) $args['id']);

        return $this->jsonResponse($response, 'success', $user, 200);
    }
}

<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $userIdLogged = $input['decoded']->sub;
        $this->checkUserPermissions((int) $args['id'], (int) $userIdLogged);
        $user = $this->getUserService()->delete((int) $args['id']);

        return $this->jsonResponse($response, 'success', $user, 204);
    }
}

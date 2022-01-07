<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $userIdLogged = $this->getAndValidateUserId($input);
        $id = (int) $args['id'];
        $this->checkUserPermissions($id, $userIdLogged);
        $this->getDeleteUserService()->delete($id);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}

<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class CreateUser extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = $request->getParsedBody();
        $user = $this->getUserService()->createUser($input);

        return $this->jsonResponse($response, 'success', $user, 201);
    }
}

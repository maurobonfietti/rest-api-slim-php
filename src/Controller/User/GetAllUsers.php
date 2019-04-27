<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAllUsers extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $users = $this->getUserService()->getUsers();

        return $this->jsonResponse('success', $users, 200);
    }
}

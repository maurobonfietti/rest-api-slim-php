<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOneUser extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $user = $this->getUserService()->getUser((int) $this->args['id']);

        return $this->jsonResponse('success', $user, 200);
    }
}

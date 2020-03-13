<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class GetAll extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $users = $this->getUserService()->getAll();

        return $this->jsonResponse($response, 'success', $users, 200);
    }
}

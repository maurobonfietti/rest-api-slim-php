<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class SearchUsers extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $users = $this->getUserService()->searchUsers($this->args['query']);

        return $this->jsonResponse('success', $users, 200);
    }
}

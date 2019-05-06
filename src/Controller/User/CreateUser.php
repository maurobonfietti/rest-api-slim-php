<?php declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

class CreateUser extends BaseUser
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->setParams($request, $response, $args);
        $input = $this->getInput();
        $user = $this->getUserService()->createUser($input);
        if ($this->useRedis() === true) {
            $this->saveInCache((int) $user->id, $user);
        }

        return $this->jsonResponse('success', $user, 201);
    }
}

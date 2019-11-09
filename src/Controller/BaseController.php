<?php declare(strict_types=1);

namespace App\Controller;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    protected function setParams(Request $request, Response $response, array $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    protected function jsonResponse(Response $response, string $status, $message, int $code):  Response
    {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $response->withJson($result, $code, JSON_PRETTY_PRINT);
    }
}

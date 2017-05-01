<?php

namespace App\Controller;

/**
 * Base Controller.
 */
abstract class BaseController
{
    const API_VERSION = '17.05';

    protected $logger;
    protected $database;
    protected $request;
    protected $response;
    protected $args;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    protected function setParams($request, $response, $args)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
        $info = [
            'method' => $this->request->getAttribute('route')->getMethods(),
            'path' => $this->request->getUri()->getPath(),
            'input' => $this->request->getParsedBody(),
            'args' => $this->args,
        ];
        $this->logger->info(json_encode($info));
    }

    /**
     * Send response with json as standard format.
     *
     * @param string $status
     * @param mixed $message
     * @param int $code
     * @return array $response
     */
    protected function jsonResponse($status, $message, $code)
    {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];
        $this->logger->info(json_encode($result));

        return $this->response->withJson($result, $code, JSON_PRETTY_PRINT);
    }
}

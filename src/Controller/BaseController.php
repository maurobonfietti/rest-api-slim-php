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
        $this->logRequest();
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
        $this->logResponse($result);

        return $this->response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

    /**
     * Log each request.
     */
    protected function logRequest()
    {
        $routeInfo = $this->request->getAttribute('routeInfo');
        $route = $this->request->getAttribute('route');
        $this->logger->info('************');
        $this->logger->info('* REQUEST: ' . $route->getCallable()[1]);
        $this->logger->info('* ' . $route->getMethods()[0] . ' ' . $routeInfo['request'][1]);
        $this->logger->info('* BODY: ' . json_encode($this->request->getParsedBody()));
//        $this->logger->info('* ARGS: ' . json_encode($this->args));
    }

    /**
     * Log each response.
     *
     * @param array $response
     */
    protected function logResponse($response)
    {
        $this->logger->info('* RESPONSE: ' . json_encode($response));
        $this->logger->info('************');
    }
}

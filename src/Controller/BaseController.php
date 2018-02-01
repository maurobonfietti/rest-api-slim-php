<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;

/**
 * Base Controller.
 */
abstract class BaseController
{
    /**
     * @var Logger $logger
     */
    protected $logger;

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
     * @return Response
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
     *
     * @return bool|void
     */
    protected function logRequest()
    {
        if (!$this->logger) {
            return false;
        }
        $routeInfo = $this->request->getAttribute('routeInfo');
        $route = $this->request->getAttribute('route');
        $this->logger->info('************');
        $this->logger->info('* REQUEST: ' . $route->getCallable()[1]);
        $this->logger->info('* ' . $route->getMethods()[0] . ' ' . $routeInfo['request'][1]);
        $this->logger->info('* BODY: ' . json_encode($this->request->getParsedBody()));
    }

    /**
     * Log each response.
     *
     * @param array $response
     * @return bool|void
     */
    protected function logResponse($response)
    {
        if (!$this->logger) {
            return false;
        }
        $this->logger->info('* RESPONSE: ' . json_encode($response));
        $this->logger->info('************');
    }
}

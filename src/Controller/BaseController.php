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

    protected function logRequest()
    {
//        $info = [
//            'method' => $this->request->getAttribute('route')->getMethods(),
//            'path' => $this->request->getUri()->getPath(),
//            'input' => $this->request->getParsedBody(),
//            'args' => $this->args,
//        ];
        

        $routeInfo = $this->request->getAttribute('routeInfo');
        $route = $this->request->getAttribute('route');
        
        $this->logger->info('**********');
        $this->logger->info('* REQUEST: ' . $route->getCallable()[1]);
        $this->logger->info('* ' . $route->getMethods()[0] . ' ' . $routeInfo['request'][1]);
        $this->logger->info('* BODY: ' . json_encode($this->request->getParsedBody()));
        $this->logger->info('* ARGS: ' . json_encode($this->args));

//        $routeName = $route->getName();
//        $groups = $route->getGroups();
//        $methods = $route->getMethods();
//        $arguments = $route->getArguments();
//
//        var_dump($route->getCallable()[1]);
//        print "Route Info: " . print_r($route, true);
//        print "Route Name: " . print_r($routeName, true);
//        print "Route Groups: " . print_r($groups, true);
//        print "Route Methods: " . print_r($methods, true);
//        print "Route Arguments: " . print_r($arguments, true);
//        exit;
//        $this->logger->info(json_encode($info));
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
//        $this->logger->info(json_encode($result));
        $this->logger->info('* RESPONSE: ' . json_encode($result));
        $this->logger->info('**********');

        return $this->response->withJson($result, $code, JSON_PRETTY_PRINT);
    }
}

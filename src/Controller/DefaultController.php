<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Message\DefaultMessage;

/**
 * Default Controller.
 */
class DefaultController extends BaseController
{
    /**
     * @param \Slim\Container $container
     */
    public function __construct(\Slim\Container $container)
    {
        $this->logger = $container->get('logger');
    }

    /**
     * Get Help.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getHelp($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
//        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url = 'http://localhost:8080/';
        $message = [
            'help' => $url . '',
            'tasks' => $url . 'tasks',
            'users' => $url . 'users',
            'version' => $url . 'version',
        ];

        return $this->jsonResponse('success', $message, 200);
    }

    /**
     * Get Api Version.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getVersion($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $version = [
            'api_version' => DefaultMessage::API_VERSION
        ];

        return $this->jsonResponse('success', $version, 200);
    }

    /**
     * Get Api Status.
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return array
     */
    public function getStatus($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $status = [
            'api_status' => 'OK'
        ];

        return $this->jsonResponse('success', $status, 200);
    }
}

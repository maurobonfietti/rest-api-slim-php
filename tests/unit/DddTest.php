<?php

namespace Tests\api;

use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

class DefaultTest2
{
    public function testHelp()
    {
        $app = new App([]);
        $request = Request::createFromEnvironment(Environment::mock([]));
        $response = $app->process($request, new Response());
        $defaultController = new \App\Controller\DefaultController(new Container());
        $result = $defaultController->getHelp($request, $response, []);
        $this->assertEquals(200, $result->getStatusCode());
    }
}

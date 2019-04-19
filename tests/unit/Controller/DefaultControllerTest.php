<?php

//namespace Tests\integration;
//
//use Slim\Container;
//use Slim\Http\Request;
//use Slim\Http\Response;
//
//class DefaultControllerTest extends BaseTestCase
//{
//    public function testGetHelp()
//    {
//        $defaultController = new \App\Controller\DefaultController(new Container());
//        $result = $defaultController->getHelp(new Request(), new Response(), []);
//
//        $this->assertInstanceOf(Response::class, $result);
//        $this->assertEquals(200, $result->getStatusCode());
//        $this->assertStringContainsString('status', (string) $result->getBody());
//        $this->assertStringContainsString('success', (string) $result->getBody());
//        $this->assertStringContainsString('version', (string) $result->getBody());
//        $this->assertStringContainsString('time', (string) $result->getBody());
//    }
//}

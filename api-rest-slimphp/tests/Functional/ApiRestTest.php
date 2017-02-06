<?php

namespace Tests\Functional;

require __DIR__.'/../../src/tasks.php';
require __DIR__.'/../../src/users.php';

class ApiRestTest extends BaseTestCase
{
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        //print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }

    public function testGetUser()
    {
        $response = $this->runApp('GET', '/users/1');

        //print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }
}
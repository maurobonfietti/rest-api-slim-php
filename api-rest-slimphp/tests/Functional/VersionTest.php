<?php

namespace Tests\Functional;

require __DIR__.'/../../src/base.php';
require __DIR__.'/../../src/users.php';
require __DIR__.'/../../src/tasks.php';
require __DIR__.'/../../src/queries.php';

class VersionTest extends BaseTestCase
{
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }

    public function testVersion()
    {
        $response = $this->runApp('GET', '/version');

        //print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('version', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }
}

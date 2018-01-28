<?php

namespace Tests\api;

class DefaultTest extends BaseTestCase
{
    /**
     * Test that default endpoint show a help.
     */
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }

    /**
     * Test that version endpoint, show the api version.
     */
    public function testVersion()
    {
        $response = $this->runApp('GET', '/version');

        //print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('version', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }


    /**
     * Test that status endpoint, show the api status ok.
     */
    public function testStatus()
    {
        $response = $this->runApp('GET', '/status');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('status', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }
}

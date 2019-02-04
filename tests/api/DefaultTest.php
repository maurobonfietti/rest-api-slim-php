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
        $this->assertContains('status', (string) $response->getBody());
        $this->assertContains('success', (string) $response->getBody());
        $this->assertContains('version', (string) $response->getBody());
        $this->assertContains('time', (string) $response->getBody());
        $this->assertContains('endpoints', (string) $response->getBody());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }

    /**
     * Test that status endpoint, show the API status.
     */
    public function testStatus()
    {
        $response = $this->runApp('GET', '/status');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('status', (string) $response->getBody());
        $this->assertContains('success', (string) $response->getBody());
        $this->assertContains('version', (string) $response->getBody());
        $this->assertContains('time', (string) $response->getBody());
        $this->assertContains('db', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }
}

<?php declare(strict_types=1);

namespace Tests\integration;

class DefaultTest extends BaseTestCase
{
    /**
     * Test that default endpoint show a help.
     */
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('status', (string) $response->getBody());
        $this->assertStringContainsString('success', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringContainsString('endpoints', (string) $response->getBody());
        $this->assertStringContainsString('help', (string) $response->getBody());
        $this->assertStringNotContainsString('ERROR', (string) $response->getBody());
        $this->assertStringNotContainsString('Failed', (string) $response->getBody());
    }

    /**
     * Test that status endpoint, show the API status.
     */
    public function testStatus()
    {
        $response = $this->runApp('GET', '/status');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('status', (string) $response->getBody());
        $this->assertStringContainsString('success', (string) $response->getBody());
        $this->assertStringContainsString('version', (string) $response->getBody());
        $this->assertStringContainsString('time', (string) $response->getBody());
        $this->assertStringContainsString('db', (string) $response->getBody());
        $this->assertStringNotContainsString('ERROR', (string) $response->getBody());
        $this->assertStringNotContainsString('Failed', (string) $response->getBody());
    }
}

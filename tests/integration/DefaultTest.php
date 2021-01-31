<?php

declare(strict_types=1);

namespace Tests\integration;

class DefaultTest extends BaseTestCase
{
    /**
     * Test that default endpoint show a help.
     */
    public function testApiHelp(): void
    {
        $response = $this->runApp('GET', '/');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringContainsString('endpoints', $result);
        $this->assertStringContainsString('help', $result);
        $this->assertStringNotContainsString('error', $result);
        $this->assertStringNotContainsString('Failed', $result);
    }

    /**
     * Test that status endpoint, show the API status.
     */
    public function testStatus(): void
    {
        $response = $this->runApp('GET', '/status');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('message', $result);
        $this->assertStringContainsString('stats', $result);
        $this->assertStringContainsString('MySQL', $result);
        $this->assertStringContainsString('Redis', $result);
        $this->assertStringContainsString('version', $result);
        $this->assertStringContainsString('time', $result);
        $this->assertStringNotContainsString('error', $result);
        $this->assertStringNotContainsString('Failed', $result);
    }

    /**
     * Test Route Not Found.
     */
    public function testRouteNotFound(): void
    {
        $response = $this->runApp('GET', '/route-not-found');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('error', $result);
    }
}

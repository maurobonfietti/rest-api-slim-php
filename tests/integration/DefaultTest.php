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
     * Test that the help and status endpoints report the controller's API version.
     */
    public function testApiVersionMatchesController(): void
    {
        $expected = new \ReflectionClassConstant(
            \App\Controller\DefaultController::class,
            'API_VERSION'
        )->getValue();

        $help = json_decode((string) $this->runApp('GET', '/')->getBody(), true);
        $status = json_decode((string) $this->runApp('GET', '/status')->getBody(), true);

        $this->assertMatchesRegularExpression('/^\d+\.\d+\.\d+$/', $expected);
        $this->assertSame($expected, $help['message']['version']);
        $this->assertSame($expected, $status['message']['version']);
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

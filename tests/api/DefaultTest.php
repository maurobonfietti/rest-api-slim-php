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

    /**
     * Test that login endpoint it is working fine.
     */
    public function testLogin()
    {
        $response = $this->runApp(
            'GET', '/login',
            ['email' => 'm@b.com.ar', 'password' => '123']
        );

        $result = (string) $response->getBody();

        self::$jwt = json_decode($result)->message->Authorization;
//        var_dump(self::$jwt); exit;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('status', (string) $response->getBody());
        $this->assertStringContainsString('success', (string) $response->getBody());
        $this->assertStringContainsString('message', (string) $response->getBody());
        $this->assertStringContainsString('Authorization', (string) $response->getBody());
        $this->assertStringContainsString('Bearer', (string) $response->getBody());
        $this->assertStringContainsString('ey', (string) $response->getBody());
        $this->assertStringNotContainsString('ERROR', (string) $response->getBody());
        $this->assertStringNotContainsString('Failed', (string) $response->getBody());
    }
}

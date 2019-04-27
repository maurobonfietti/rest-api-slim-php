<?php declare(strict_types=1);

namespace Tests\integration;

class AuthLoginTest extends BaseTestCase
{
    /**
     * Test user login endpoint and get a JWT Bearer Authorization.
     */
    public function testLogin()
    {
        $response = $this->runApp('POST', '/login', ['email' => 'test@user.com', 'password' => 'AnyPass1000']);

        $result = (string) $response->getBody();

        self::$jwt = json_decode($result)->message->Authorization;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Authorization', $result);
        $this->assertStringContainsString('Bearer', $result);
    }
}

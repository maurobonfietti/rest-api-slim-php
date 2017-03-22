<?php

namespace Tests\Functional;

require __DIR__.'/../../src/users.php';

class UsersTest extends BaseTestCase
{
    private static $id;

    public function testGetUsers()
    {
        $response = $this->runApp('GET', '/users');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testGetUser()
    {
        $response = $this->runApp('GET', '/users/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testGetUserNotFound()
    {
        $response = $this->runApp('GET', '/users/123456');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', (string) $response->getBody());
        $this->assertNotContains('name', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }

    public function testSearchUsers()
    {
        $response = $this->runApp('GET', '/users/search/j');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('juan', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testSearchUserNotFound()
    {
        $response = $this->runApp('GET', '/users/search/123456');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', (string) $response->getBody());
        $this->assertNotContains('name', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }

    public function testCreateUser()
    {
        $response = $this->runApp('POST', '/users', array('name' => 'Esteban'));

        self::$id = json_decode((string) $response->getBody())->message->id;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Esteban', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testUpdateUser()
    {
        $response = $this->runApp('PUT', '/users/' . self::$id, array('name' => 'Tommy'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('name', (string) $response->getBody());
        $this->assertContains('Tommy', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testUpdateUserNotFound()
    {
        $response = $this->runApp('PUT', '/users/123456', array('name' => 'Tommy'));

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', (string) $response->getBody());
        $this->assertNotContains('name', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }

    public function testDeleteUser()
    {
        $response = $this->runApp('DELETE', '/users/' . self::$id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testDeleteUserNotFound()
    {
        $response = $this->runApp('DELETE', '/users/123456');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }
}

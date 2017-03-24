<?php

namespace Tests\Functional;

require __DIR__.'/../../src/users.php';

class UsersTest extends BaseTestCase
{
    private static $id;

    public function testGetUsers()
    {
        $response = $this->runApp('GET', '/users');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Juan', $result);
        $this->assertNotContains('error', $result);
    }

    public function testGetUser()
    {
        $response = $this->runApp('GET', '/users/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Juan', $result);
        $this->assertNotContains('error', $result);
    }

    public function testGetUserNotFound()
    {
        $response = $this->runApp('GET', '/users/123456');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testSearchUsers()
    {
        $response = $this->runApp('GET', '/users/search/j');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('juan', $result);
        $this->assertNotContains('error', $result);
    }

    public function testSearchUserNotFound()
    {
        $response = $this->runApp('GET', '/users/search/123456');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testCreateUser()
    {
        $response = $this->runApp('POST', '/users', array('name' => 'Esteban'));

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Esteban', $result);
        $this->assertNotContains('error', $result);
    }

    public function testCreateUserWithOutName()
    {
        $response = $this->runApp('POST', '/users');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testUpdateUser()
    {
        $response = $this->runApp('PUT', '/users/' . self::$id, array('name' => 'Tommy'));

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Tommy', $result);
        $this->assertNotContains('error', $result);
    }

    public function testUpdateUserWithOutName()
    {
        $response = $this->runApp('PUT', '/users/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testUpdateUserNotFound()
    {
        $response = $this->runApp('PUT', '/users/123456', array('name' => 'Tommy'));

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testDeleteUser()
    {
        $response = $this->runApp('DELETE', '/users/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', $result);
        $this->assertNotContains('error', $result);
    }

    public function testDeleteUserNotFound()
    {
        $response = $this->runApp('DELETE', '/users/123456');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', $result);
        $this->assertContains('error', $result);
    }
}

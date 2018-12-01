<?php

namespace Tests\api;

class UserTest extends BaseTestCase
{
    private static $id;

    /**
     * Test Get All Users.
     */
    public function testGetUsers()
    {
        $response = $this->runApp('GET', '/api/v1/users');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Juan', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get One User.
     */
    public function testGetUser()
    {
        $response = $this->runApp('GET', '/api/v1/users/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Juan', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get User Not Found.
     */
    public function testGetUserNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/users/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Search Users.
     */
    public function testSearchUsers()
    {
        $response = $this->runApp('GET', '/api/v1/users/search/j');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Juan', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Search User Not Found.
     */
    public function testSearchUserNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/users/search/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Create User.
     */
    public function testCreateUser()
    {
        $response = $this->runApp(
            'POST', '/api/v1/users',
            ['name' => 'Esteban', 'email' => 'estu@gmail.com']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Esteban', $result);
        $this->assertContains('estu@gmail.com', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Create User Without Name.
     */
    public function testCreateUserWithoutName()
    {
        $response = $this->runApp('POST', '/api/v1/users');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Create User With Invalid Name.
     */
    public function testCreateUserWithInvalidName()
    {
        $response = $this->runApp(
            'POST', '/api/v1/users',
            ['name' => 'z', 'email' => 'email@example.com']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Create User With Invalid Email.
     */
    public function testCreateUserWithInvalidEmail()
    {
        $response = $this->runApp(
            'POST', '/api/v1/users',
            ['name' => 'Esteban', 'email' => 'email.incorrecto']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Update User.
     */
    public function testUpdateUser()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/users/' . self::$id,
            ['name' => 'Victor', 'email' => 'victor@hotmail.com']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Victor', $result);
        $this->assertContains('hotmail', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Update User Without Send Data.
     */
    public function testUpdateUserWithOutSendData()
    {
        $response = $this->runApp('PUT', '/api/v1/users/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Update User Not Found.
     */
    public function testUpdateUserNotFound()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/users/123456789', ['name' => 'Victor']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Update User With Invalid Data.
     */
    public function testUpdateUserWithInvalidData()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/users/' . self::$id,
            ['name' => 'z', 'email' => 'email-incorrecto...']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Delete User.
     */
    public function testDeleteUser()
    {
        $response = $this->runApp('DELETE', '/api/v1/users/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Delete User Not Found.
     */
    public function testDeleteUserNotFound()
    {
        $response = $this->runApp('DELETE', '/api/v1/users/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', $result);
        $this->assertContains('error', $result);
    }
}

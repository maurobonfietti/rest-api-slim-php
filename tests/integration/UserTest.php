<?php declare(strict_types=1);

namespace Tests\integration;

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
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('email', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get One User.
     */
    public function testGetUser()
    {
        $response = $this->runApp('GET', '/api/v1/users/8');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('email', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get User Not Found.
     */
    public function testGetUserNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/users/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('name', $result);
        $this->assertStringNotContainsString('email', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Search Users.
     */
    public function testSearchUsers()
    {
        $response = $this->runApp('GET', '/api/v1/users/search/j');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('email', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search User Not Found.
     */
    public function testSearchUserNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/users/search/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('email', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create User.
     */
    public function testCreateUser()
    {
        $response = $this->runApp(
            'POST', '/api/v1/users',
            ['name' => 'Esteban', 'email' => 'estu@gmail.com', 'password' => 'AnyPass1000']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('email', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create User Without Name.
     */
    public function testCreateUserWithoutName()
    {
        $response = $this->runApp('POST', '/api/v1/users');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('email', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create User Without Email.
     */
    public function testCreateUserWithoutEmail()
    {
        $response = $this->runApp('POST', '/api/v1/users', ['name' => 'z']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
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
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('email', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create User With Invalid Email.
     */
    public function testCreateUserWithInvalidEmail()
    {
        $response = $this->runApp(
            'POST', '/api/v1/users',
            ['name' => 'Esteban', 'email' => 'email.incorrecto', 'password' => 'AnyPass1000']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create User With An Email That Already Exists.
     */
    public function testCreateUserWithEmailAlreadyExists()
    {
        $response = $this->runApp(
            'POST', '/api/v1/users',
            ['name' => 'Esteban', 'email' => 'estu@gmail.com', 'password' => 'AnyPass1000']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update User.
     */
    public function testUpdateUser()
    {
        $response0 = $this->runApp('POST', '/login', ['email' => 'estu@gmail.com', 'password' => 'AnyPass1000']);
        $result0 = (string) $response0->getBody();
        self::$jwt = json_decode($result0)->message->Authorization;

        $response = $this->runApp('PUT', '/api/v1/users/' . self::$id, ['name' => 'Stu', 'email' => 'estu@gmail.com']);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('email', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Update User Without Send Data.
     */
    public function testUpdateUserWithOutSendData()
    {
        $response = $this->runApp('PUT', '/api/v1/users/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('email', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update User Permissions Failed.
     */
    public function testUpdateUserPermissionsFailed()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/users/1', ['name' => 'Victor']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('name', $result);
        $this->assertStringContainsString('error', $result);
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
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('email', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Delete User.
     */
    public function testDeleteUser()
    {
        $response = $this->runApp('DELETE', '/api/v1/users/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Delete User Permissions Failed.
     */
    public function testDeleteUserPermissionsFailed()
    {
        $response = $this->runApp('DELETE', '/api/v1/users/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test that user login endpoint it is working fine.
     */
    public function testLoginUser()
    {
        $response = $this->runApp('POST', '/login', ['email' => 'test@user.com', 'password' => 'AnyPass1000']);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('message', $result);
        $this->assertStringContainsString('Authorization', $result);
        $this->assertStringContainsString('Bearer', $result);
        $this->assertStringContainsString('ey', $result);
        $this->assertStringNotContainsString('ERROR', $result);
        $this->assertStringNotContainsString('Failed', $result);
    }

    /**
     * Test login endpoint with invalid credentials.
     */
    public function testLoginUserFailed()
    {
        $response = $this->runApp('POST', '/login', ['email' => 'a@b.com', 'password' => 'p']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('Login failed', $result);
        $this->assertStringContainsString('UserException', $result);
        $this->assertStringContainsString('error', $result);
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('Authorization', $result);
        $this->assertStringNotContainsString('Bearer', $result);
    }

    /**
     * Test login endpoint without send required field email.
     */
    public function testLoginWithoutEmailField()
    {
        $response = $this->runApp('POST', '/login', ['password' => 'p']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('UserException', $result);
        $this->assertStringContainsString('error', $result);
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('Authorization', $result);
        $this->assertStringNotContainsString('Bearer', $result);
    }

    /**
     * Test login endpoint without send required field password.
     */
    public function testLoginWithoutPasswordField()
    {
        $response = $this->runApp('POST', '/login', ['email' => 'a@b.com']);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('UserException', $result);
        $this->assertStringContainsString('error', $result);
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('Authorization', $result);
        $this->assertStringNotContainsString('Bearer', $result);
    }
}

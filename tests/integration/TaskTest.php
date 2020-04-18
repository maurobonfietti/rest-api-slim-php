<?php

declare(strict_types=1);

namespace Tests\integration;

class TaskTest extends BaseTestCase
{
    /**
     * @var int
     */
    private static $id;

    /**
     * Test Get All Tasks.
     */
    public function testGetTasks(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get One Task.
     */
    public function testGetTask(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get Task Not Found.
     */
    public function testGetTaskNotFound(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Search All Tasks.
     */
    public function testSearchAllTasks(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Tasks By Name.
     */
    public function testSearchTasksByName(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/cine');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Tasks with Status Done.
     */
    public function testSearchTasksWithStatusDone(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/?status=1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Tasks with status = 0.
     */
    public function testSearchTasksWithStatusToDo(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/?status=0');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create Task.
     */
    public function testCreateTask(): void
    {
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'New Task', 'description' => 'My Desc.']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get Task Created.
     */
    public function testGetTaskCreated(): void
    {
        $response = $this->runApp('GET', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create Task Without Name.
     */
    public function testCreateTaskWithOutTaskName(): void
    {
        $response = $this->runApp('POST', '/api/v1/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid TaskName.
     */
    public function testCreateTaskWithInvalidTaskName(): void
    {
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'z', 'status' => 1]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid Status.
     */
    public function testCreateTaskWithInvalidStatus(): void
    {
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'ToDo', 'status' => 123]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task Without Authorization Bearer JWT.
     */
    public function testCreateTaskWithoutBearerJWT(): void
    {
        $auth = self::$jwt;
        self::$jwt = '';
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'my task', 'status' => 0]
        );
        self::$jwt = $auth;

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid JWT.
     */
    public function testCreateTaskWithInvalidJWT(): void
    {
        $auth = self::$jwt;
        self::$jwt = 'invalidToken';
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'my task', 'status' => 0]
        );
        self::$jwt = $auth;

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Forbidden JWT.
     */
    public function testCreateTaskWithForbiddenJWT(): void
    {
        $auth = self::$jwt;
        self::$jwt = 'Bearer eyJ0eXAiOiJK1NiJ9.eyJzdWIiOiI4Ii';
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'my task', 'status' => 0]
        );
        self::$jwt = $auth;

        $result = (string) $response->getBody();

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Task.
     */
    public function testUpdateTask(): void
    {
        $response = $this->runApp(
            'PUT', '/api/v1/tasks/' . self::$id,
            ['name' => 'Update Task', 'description' => 'Update Desc', 'status' => 1]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Update Task Without Send Data.
     */
    public function testUpdateTaskWithOutSendData(): void
    {
        $response = $this->runApp('PUT', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Task Not Found.
     */
    public function testUpdateTaskNotFound(): void
    {
        $response = $this->runApp(
            'PUT', '/api/v1/tasks/123456789', ['name' => 'Task']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Delete Task.
     */
    public function testDeleteTask(): void
    {
        $response = $this->runApp('DELETE', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertStringContainsString('success', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Delete Task Not Found.
     */
    public function testDeleteTaskNotFound(): void
    {
        $response = $this->runApp('DELETE', '/api/v1/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('application/problem+json', $response->getHeaderLine('Content-Type'));
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringContainsString('error', $result);
    }
}

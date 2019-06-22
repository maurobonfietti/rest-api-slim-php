<?php declare(strict_types=1);

namespace Tests\integration;

class TaskTest extends BaseTestCase
{
    private static $id;

    /**
     * Test Get All Tasks.
     */
    public function testGetTasks()
    {
        $response = $this->runApp('GET', '/api/v1/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get One Task.
     */
    public function testGetTask()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Get Task Not Found.
     */
    public function testGetTaskNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Search All Tasks.
     */
    public function testSearchAllTasks()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Tasks By Name.
     */
    public function testSearchTasksByName()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/cine');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Tasks with Status Done.
     */
    public function testSearchTasksWithStatusDone()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/?status=1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Search Tasks with status = 0.
     */
    public function testSearchTasksWithStatusToDo()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/?status=0');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create Task.
     */
    public function testCreateTask()
    {
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'New Task']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Create Task Without Name.
     */
    public function testCreateTaskWithOutTaskName()
    {
        $response = $this->runApp('POST', '/api/v1/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid TaskName.
     */
    public function testCreateTaskWithInvalidTaskName()
    {
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'z', 'status' => 1]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Invalid Status.
     */
    public function testCreateTaskWithInvalidStatus()
    {
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'ToDo', 'status' => 123]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task With Forbidden JWT.
     */
    public function testCreateTaskWithInvalidJWT()
    {
        $auth = self::$jwt;
        self::$jwt = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiI4Ii';
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'my task', 'status' => 0]
        );
        self::$jwt = $auth;

        $result = (string) $response->getBody();

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Create Task Without Bearer JWT Auth.
     */
    public function testCreateTaskWithoutBearerJWT()
    {
        $auth = self::$jwt;
        self::$jwt = 'Bearer ';
        $response = $this->runApp(
            'POST', '/api/v1/tasks', ['name' => 'my task', 'status' => 0]
        );
        self::$jwt = $auth;

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Task.
     */
    public function testUpdateTask()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/tasks/' . self::$id,
            ['name' => 'Update Task', 'status' => 1]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringContainsString('id', $result);
        $this->assertStringContainsString('name', $result);
        $this->assertStringContainsString('status', $result);
        $this->assertStringContainsString('updated', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Update Task Without Send Data.
     */
    public function testUpdateTaskWithOutSendData()
    {
        $response = $this->runApp('PUT', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Update Task Not Found.
     */
    public function testUpdateTaskNotFound()
    {
        $response = $this->runApp(
            'PUT', '/api/v1/tasks/123456789', ['name' => 'Task']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }

    /**
     * Test Delete Task.
     */
    public function testDeleteTask()
    {
        $response = $this->runApp('DELETE', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertStringContainsString('success', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    /**
     * Test Delete Task Not Found.
     */
    public function testDeleteTaskNotFound()
    {
        $response = $this->runApp('DELETE', '/api/v1/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringNotContainsString('success', $result);
        $this->assertStringNotContainsString('id', $result);
        $this->assertStringNotContainsString('updated', $result);
        $this->assertStringContainsString('error', $result);
    }
}

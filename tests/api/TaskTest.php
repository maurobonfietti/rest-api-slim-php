<?php

namespace Tests\api;

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
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('cine', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get One Task.
     */
    public function testGetTask()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('cine', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get Task Not Found.
     */
    public function testGetTaskNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Search Tasks.
     */
    public function testSearchTasks()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/cine');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('cine', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Search Task Not Found.
     */
    public function testSearchTaskNotFound()
    {
        $response = $this->runApp('GET', '/api/v1/tasks/search/bug123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Task', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Create Task Without Name.
     */
    public function testCreateTaskWithOutTaskName()
    {
        $response = $this->runApp('POST', '/api/v1/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertContains('id', $result);
        $this->assertContains('name', $result);
        $this->assertContains('Task', $result);
        $this->assertContains('status', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Update Task Without Send Data.
     */
    public function testUpdateTaskWithOutSendData()
    {
        $response = $this->runApp('PUT', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
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
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertNotContains('Task', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Delete Task.
     */
    public function testDeleteTask()
    {
        $response = $this->runApp('DELETE', '/api/v1/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Delete Task Not Found.
     */
    public function testDeleteTaskNotFound()
    {
        $response = $this->runApp('DELETE', '/api/v1/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', $result);
        $this->assertContains('error', $result);
    }
}

<?php

namespace Tests\Controller;

class TasksTest extends BaseTestCase
{
    private static $id;

    /**
     * Test Get All Tasks.
     */
    public function testGetTasks()
    {
        $response = $this->runApp('GET', '/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('super', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get One Task.
     */
    public function testGetTask()
    {
        $response = $this->runApp('GET', '/tasks/3');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('super', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Get Task Not Found.
     */
    public function testGetTaskNotFound()
    {
        $response = $this->runApp('GET', '/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Search Tasks.
     */
    public function testSearchTasks()
    {
        $response = $this->runApp('GET', '/tasks/search/super');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('super', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Search Task Not Found.
     */
    public function testSearchTaskNotFound()
    {
        $response = $this->runApp('GET', '/tasks/search/bug123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Create Task.
     */
    public function testCreateTask()
    {
        $response = $this->runApp(
            'POST', '/tasks', ['task' => 'Nueva Tarea']
        );

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('Tarea', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Create Task Without Name.
     */
    public function testCreateTaskWithOutTaskName()
    {
        $response = $this->runApp('POST', '/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Update Task.
     */
    public function testUpdateTask()
    {
        $response = $this->runApp(
            'PUT', '/tasks/' . self::$id,
            ['task' => 'Actualizar Tarea', 'status' => 1]
        );

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('Tarea', $result);
        $this->assertContains('status', $result);
        $this->assertNotContains('error', $result);
    }

    /**
     * Test Update Task Without Send Data.
     */
    public function testUpdateTaskWithOutSendData()
    {
        $response = $this->runApp('PUT', '/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Update Task Not Found.
     */
    public function testUpdateTaskNotFound()
    {
        $response = $this->runApp(
            'PUT', '/tasks/123456789', ['task' => 'Actualizar Tarea']
        );

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertNotContains('Tarea', $result);
        $this->assertContains('error', $result);
    }

    /**
     * Test Delete Task.
     */
    public function testDeleteTask()
    {
        $response = $this->runApp('DELETE', '/tasks/' . self::$id);

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
        $response = $this->runApp('DELETE', '/tasks/123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', $result);
        $this->assertContains('error', $result);
    }
}

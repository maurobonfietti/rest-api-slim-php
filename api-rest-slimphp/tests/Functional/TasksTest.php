<?php

namespace Tests\Functional;

class TasksTest extends BaseTestCase
{
    private static $id;

    public function testGetTasks()
    {
        $response = $this->runApp('GET', '/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('Fix', $result);
        $this->assertNotContains('error', $result);
    }

    public function testGetTask()
    {
        $response = $this->runApp('GET', '/tasks/1');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('Find', $result);
        $this->assertNotContains('error', $result);
    }

    public function testGetTaskNotFound()
    {
        $response = $this->runApp('GET', '/tasks/123456');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertContains('error', $result);
    }

    public function testSearchTasks()
    {
        $response = $this->runApp('GET', '/tasks/search/bug');

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('bugs', $result);
        $this->assertNotContains('error', $result);
    }

    public function testSearchTaskNotFound()
    {
        $response = $this->runApp('GET', '/tasks/search/bug123456789');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertNotContains('bugs', $result);
        $this->assertContains('error', $result);
    }

    public function testCreateTask()
    {
        $response = $this->runApp('POST', '/tasks', array('task' => 'Nueva Tarea'));

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->message->id;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('Tarea', $result);
        $this->assertNotContains('error', $result);
    }

    public function testCreateTaskWithOutTaskName()
    {
        $response = $this->runApp('POST', '/tasks');

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testUpdateTask()
    {
        $response = $this->runApp('PUT', '/tasks/' . self::$id, array('task' => 'Ir al super.'));

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', $result);
        $this->assertContains('task', $result);
        $this->assertContains('super', $result);
        $this->assertNotContains('error', $result);
    }

    public function testUpdateTaskWithOutTaskName()
    {
        $response = $this->runApp('PUT', '/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('name', $result);
        $this->assertContains('error', $result);
    }

    public function testUpdateTaskNotFound()
    {
        $response = $this->runApp('PUT', '/tasks/123456789', array('task' => 'Ir a dormir :-P'));

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', $result);
        $this->assertNotContains('task', $result);
        $this->assertNotContains('dormir', $result);
        $this->assertContains('error', $result);
    }

    public function testDeleteTask()
    {
        $response = $this->runApp('DELETE', '/tasks/' . self::$id);

        $result = (string) $response->getBody();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', $result);
        $this->assertNotContains('error', $result);
    }

    public function testDeleteTaskNotFound()
    {
        $response = $this->runApp('DELETE', '/tasks/123456');

        $result = (string) $response->getBody();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', $result);
        $this->assertContains('error', $result);
    }
}

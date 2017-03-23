<?php

namespace Tests\Functional;

require __DIR__.'/../../src/tasks.php';

class TasksTest extends BaseTestCase
{
    private static $id;

    public function testGetTasks()
    {
        $response = $this->runApp('GET', '/tasks');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('Fix', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testGetTask()
    {
        $response = $this->runApp('GET', '/tasks/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('Find', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testSearchTasks()
    {
        $response = $this->runApp('GET', '/tasks/search/bug');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('bugs', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testSearchTaskNotFound()
    {
        $response = $this->runApp('GET', '/tasks/search/bug123456789');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', (string) $response->getBody());
        $this->assertNotContains('task', (string) $response->getBody());
        $this->assertNotContains('bugs', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }

    public function testCreateTask()
    {
        $response = $this->runApp('POST', '/tasks', array('task' => 'Nueva Tarea'));

        self::$id = json_decode((string) $response->getBody())->message->id;

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('Tarea', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testUpdateTask()
    {
        $response = $this->runApp('PUT', '/tasks/' . self::$id, array('task' => 'Ir al super.'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('super', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testUpdateTaskNotFound()
    {
        $response = $this->runApp('PUT', '/tasks/123456789', array('task' => 'Ir a dormir :-p'));

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('id', (string) $response->getBody());
        $this->assertNotContains('task', (string) $response->getBody());
        $this->assertNotContains('dormir', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }

    public function testDeleteTask()
    {
        $response = $this->runApp('DELETE', '/tasks/' . self::$id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('success', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testDeleteTaskNotFound()
    {
        $response = $this->runApp('DELETE', '/tasks/123456');

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertNotContains('success', (string) $response->getBody());
        $this->assertContains('error', (string) $response->getBody());
    }
}

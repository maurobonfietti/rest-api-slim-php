<?php

namespace Tests\Functional;

require __DIR__.'/../../src/tasks.php';

class TasksTest extends BaseTestCase
{
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

    public function testCreateTask()
    {
        $response = $this->runApp('POST', '/tasks', array('task' => 'Nueva Tarea'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('Tarea', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testUpdateTask()
    {
        $response = $this->runApp('PUT', '/tasks/4', array('task' => 'Ir al super.'));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('id', (string) $response->getBody());
        $this->assertContains('task', (string) $response->getBody());
        $this->assertContains('super', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }

    public function testDeleteTask()
    {
        $response = $this->runApp('DELETE', '/tasks/5');

//        print_r((string) $response->getBody());

        $this->assertEquals(200, $response->getStatusCode());
//        $this->assertContains('success', (string) $response->getBody());
        $this->assertNotContains('error', (string) $response->getBody());
    }
}
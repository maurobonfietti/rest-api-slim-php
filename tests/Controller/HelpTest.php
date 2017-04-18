<?php

namespace Tests\Controller;

require __DIR__.'/../../src/Controller/Base.php';
require __DIR__.'/../../src/Controller/DefaultController.php';
require __DIR__.'/../../src/Controller/TasksController.php';
require __DIR__.'/../../src/Controller/UsersController.php';
require __DIR__.'/../../src/Repository/UsersRepository.php';
require __DIR__.'/../../src/Service/TasksService.php';
require __DIR__.'/../../src/Service/UsersService.php';

class HelpTest extends BaseTestCase
{
    /**
     * Test that default endpoint show a help.
     */
    public function testApiHelp()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('help', (string) $response->getBody());
        $this->assertNotContains('ERROR', (string) $response->getBody());
        $this->assertNotContains('Failed', (string) $response->getBody());
    }
}
